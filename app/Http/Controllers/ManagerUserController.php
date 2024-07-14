<?php

namespace App\Http\Controllers;

use App\Models\ManagerClient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
        $clients = $manager->clients()->get()->sortByDesc('updated_at');

        return view('manager.users.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('manager.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function () use ($request) {
            $client = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($client));

            /** @var User $manager */
            $manager = auth()->user();

            $manager->clients()->attach($client->id);
        });
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $client): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('manager.users.edit', compact('client'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManagerClient $client): \Illuminate\Http\RedirectResponse
    {
        $client->delete();

        return redirect()->route('manager-users.list')->with('success', 'Package deleted successfully.');
    }

}
