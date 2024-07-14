<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagerPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::with('packages')->get();

        return view('admin.user_packages.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('manager.user_packages.create', ['servicesByType' => ApiService::all()->groupBy('type')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NakretkaPackagesStoreRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(NakrutkaPackages $nakrutkaPackages): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageService $package): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NakretkaPackagesUpdateRequest $request, PackageService $package): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('users-packages.list')->with('success', 'Package deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageService $package): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('manager-users.list')->with('success', 'Package deleted successfully.');
    }
}
