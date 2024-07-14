<?php

namespace App\Http\Controllers;

use App\Http\Requests\Packages\NakretkaPackagesStoreRequest;
use App\Http\Requests\Packages\NakretkaPackagesUpdateRequest;
use App\Models\ApiService;
use App\Models\PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NakrutkaPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.packages.index', ['packages' => PackageService::all()->sortByDesc('updated_at')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.packages.create', ['servicesByType' => ApiService::all()->groupBy('type')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NakretkaPackagesStoreRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $package = PackageService::create($data);

            foreach ($data['services'] as $serviceId) {
                $package->services()->attach($serviceId);
            }
        });

        return redirect()->route('packages.list')->with('success', 'Package created successfully.');
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
        $servicesByType = ApiService::all()->groupBy('type');
        return view('admin.packages.edit', compact('package', 'servicesByType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NakretkaPackagesUpdateRequest $request, PackageService $package): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        DB::transaction(static function () use (&$package, &$data) {
            $package->update($data);
            $package->services()->sync([]);

            foreach ($data['services'] as $typeServices) {
                $package->services()->attach($typeServices);
            }
        });

        return redirect()->route('packages.list')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageService $package): \Illuminate\Http\RedirectResponse
    {
        DB::transaction(static function () use ($package) {
            $package->services()->detach(); // Удаление всех связей с сервисами
            $package->delete(); // Удаление самого пакета
        });

        return redirect()->route('packages.list')->with('success', 'Package deleted successfully.');
    }
}
