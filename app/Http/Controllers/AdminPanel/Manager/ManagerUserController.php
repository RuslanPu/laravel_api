<?php

namespace App\Http\Controllers\AdminPanel\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Clients\ClientsStoreRequest;
use App\Http\Requests\Manager\Clients\ClientsUpdateRequest;
use App\Models\SocialAccount;
use App\Models\SocialAccountType;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var User $manager */
        $manager = auth()->user();
        $clients = $manager->clients()
            ->with('account')
            ->get()
            ->sortByDesc('updated_at');

        return view('manager.users.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var User $manager */
        $manager = auth()->user();
        $packages = $manager->activeManagerPackages()->get();
        $accountTypes = SocialAccountType::all();

        return view('manager.users.create', compact('packages', 'accountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientsStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        DB::transaction(function () use ($data) {
            /** @var User $client */
            $client = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            /** @var User $manager */
            $manager = auth()->user();

            $manager->clients()->attach($client->id);

            //Create account
            $account = $client->account()->create([
                'account_link' => $data['account_link'],
                'social_account_type_id' => $data['account_type']
            ]);

            //Sync packages
            if (isset($data['packages'])) {
                $client->clientPackageService()->attach($data['packages'], ['social_account_id' => $account->id]);
            }

            // Create publication links
            $this->createPublicationLinks($data, $client, $account);
        });

        return redirect()->route('manager-users.list')->with('success', 'Client created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $client): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var User $manager */
        $manager = auth()->user();
        $managerPackages = $manager->activeManagerPackages()->get();
        $clientPackagesIds = $client->clientPackageService()->pluck('package_services.id')->toArray();
        $accountTypes = SocialAccountType::all();

        return view('manager.users.edit', compact('client', 'managerPackages', 'clientPackagesIds', 'accountTypes'));
    }

    /**
     * @param ClientsUpdateRequest $request
     * @param User $client
     * @return RedirectResponse
     */
    public function update(ClientsUpdateRequest $request, User $client): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($client, $data) {
            // Обновление данных клиента
            /** @var User $user */
            $client->update([
                'name' => $data['name'],
                'email' => $data['email']
            ]);

            // Обновление аккаунта клиента
            $account = $client->account()->updateOrCreate([
                'social_account_type_id' => $data['account_type'],
                'account_link' => $data['account_link']
            ]);


            // Обновление пакетов клиента
            if (isset($data['packages'])) {
                $pivotData = [];
                foreach ($data['packages'] as $packageId) {
                    $pivotData[$packageId] = ['social_account_id' => $account->id];
                }
                $client->clientPackageService()->sync($pivotData);
            } else {
                $client->clientPackageService()->detach();
            }

            // Create publication links
            $client->socialAccountPublicationsLinks()->delete();
            $this->createPublicationLinks($data, $client, $account);
        });

        return redirect()->route('manager-users.list')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $client): RedirectResponse
    {
        DB::transaction(function () use ($client) {
            $client->clientPackageService()->detach(); // Delete related with service
            $client->managerClient()->delete(); //Delete related with manager
            //$client->nakrutkaOrders()->delete(); //Delete orders
            $client->clientPackages()->delete(); //Delete user packages
            $client->account->publicationsLinks()->delete(); //Delete publications links
            $client->account()->delete(); //Delete account
            $client->delete();
        });

        return redirect()->route('manager-users.list')->with('success', 'Package deleted successfully.');
    }

    /**
     * @param mixed $data
     * @param User $client
     * @param SocialAccount $account
     * @return void
     */
    public function createPublicationLinks(mixed $data, User $client, SocialAccount $account): void
    {
        if (isset($data['publication_links'])) {
            $client->clientPackages->map(function ($clientPackage) use ($account, $client, $data) {
                $publicationLinksData = array_map(static function ($link) use ($clientPackage, $account, $client) {
                    return [
                        'user_package_id' => $clientPackage->id,
                        'publication_link' => $link,
                        'social_account_id' => $account->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data['publication_links']);

                $client->socialAccountPublicationsLinks()->insert($publicationLinksData);
            });
        }
    }

}
