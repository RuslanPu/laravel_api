<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manager\Clients\ClientsStoreRequest;
use App\Http\Requests\Manager\Clients\ClientsUpdateRequest;
use App\Models\ManagerClient;
use App\Models\SocialAccountType;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ManagerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var User $manager */
        $manager = auth()->user();
        $clients = $manager->clients()->with('account')->get()->sortByDesc('updated_at');

        return view('manager.users.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var User $manager */
        $manager = auth()->user();
        $packages = $manager->managerPackages()->get();
        $accountTypes = SocialAccountType::all();

        return view('manager.users.create', compact('packages', 'accountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientsStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        DB::transaction(static function () use ($data) {
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
            $account = $client->accounts()->create([
                'account_link' => $data['account_link'],
                'social_account_type_id' => $data['account_type']
            ]);

            //Sync packages
            if (isset($data['packages'])) {
                $client->clientPackages()->attach($data['packages'], ['social_account_id' => $account->id]);
            }
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
        $managerPackages = $manager->managerPackages()->get();
        $clientPackagesIds = $client->clientPackages()->pluck('package_services.id')->toArray();
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

        DB::transaction(static function () use ($client, $data) {
            // Обновление данных клиента
            /** @var User $user */
            $client->update([
                'name' => $data['name'],
                'email' => $data['email']
            ]);

            // Обновление аккаунта клиента
            if ($client->account) {
                $client->account()->update([
                    'social_account_type_id' => $data['account_type'],
                    'account_link' => $data['account_link']
                ]);
            } else {
                $client->account()->create([
                    'social_account_type_id' => $data['account_type'],
                    'account_link' => $data['account_link']
                ]);
            }

            // Обновление пакетов клиента
            if (isset($data['packages'])) {
                $client->clientPackages()->sync($data['packages']);
            } else {
                $client->clientPackages()->detach();
            }
        });

        return redirect()->route('manager-users.list')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $client): RedirectResponse
    {
        DB::transaction(function () use ($client) {
            $client->clientPackages()->detach();
            $client->managerClient()->delete();
            $client->delete();
        });

        return redirect()->route('manager-users.list')->with('success', 'Package deleted successfully.');
    }

}
