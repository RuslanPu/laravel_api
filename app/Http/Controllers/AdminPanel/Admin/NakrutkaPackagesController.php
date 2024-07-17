<?php

namespace App\Http\Controllers\AdminPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Packages\NakretkaPackagesStoreRequest;
use App\Http\Requests\Packages\NakretkaPackagesUpdateRequest;
use App\Models\ApiService;
use App\Models\PackageService;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NakrutkaPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.packages.index', [
            'packages' => PackageService::query()
                ->where('active' , true)
                ->with(['services', 'packageApiServices'])
                ->get()
                ->sortByDesc('updated_at')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $services = ApiService::query()
            ->with('serviceCategory')->get();

        $servicesByCategory = $services->groupBy(function ($service) {
            return $service->serviceCategory->title;
        });

        return view('admin.packages.create', [
            'managers' => User::Managers()->get(),
            'servicesByCategory' => $servicesByCategory]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NakretkaPackagesStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $package = PackageService::create($data);

            foreach ($data['services'] as $serviceId) {
                $quantity = $data['quantities'][$serviceId] ?? null;
                $comments = $data['comments'][$serviceId] ?? null;

                $package->services()->attach($serviceId, compact('quantity', 'comments'));
            }

            foreach ($data['managers'] as $managerId) {
                $package->managers()->attach($managerId);
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
        $services = ApiService::with('serviceCategory')->get();

        $servicesByCategory = $services->groupBy(function ($service) {
            return $service->serviceCategory->title;
        });

        $managers = User::Managers()->get();

        $packageServices = $package->packageApiServices()->with(['service', 'package'])->get();

        return view('admin.packages.edit', compact('package', 'servicesByCategory', 'managers', 'packageServices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NakretkaPackagesUpdateRequest $request, PackageService $package): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        DB::transaction(static function () use (&$package, &$data) {
            $package->update($data);

            // Синхронизация услуг
            $servicesData = [];
            foreach ($data['services'] as $serviceId) {
                $servicesData[$serviceId] = [
                    'quantity' => $data['quantities'][$serviceId] ?? null,
                    'comments' => $data['comments'][$serviceId] ?? null,
                ];
            }

            $package->services()->sync($servicesData);

            // Синхронизация менеджеров
            $package->managers()->sync($data['managers']);
        });

        return redirect()->route('packages.list')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageService $package): \Illuminate\Http\RedirectResponse
    {
        DB::transaction(static function () use ($package) {
            //$package->managers()->detach(); //Удаление всех связей с менеджерами
            //$package->services()->detach(); // Удаление всех связей с сервисами
            $package->update(['active' => false]); // Удаление самого пакета
        });

        return redirect()->route('packages.list')->with('success', 'Package deleted successfully.');
    }
}
