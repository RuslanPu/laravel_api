<?php

namespace App\Http\Controllers;

use App\Models\PackageService;
use Illuminate\Http\Request;

class NakrutkaPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.packages.index', ['packages' => PackageService::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NakrutkaPackages $nakrutkaPackages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NakrutkaPackages $nakrutkaPackages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NakrutkaPackages $nakrutkaPackages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NakrutkaPackages $nakrutkaPackages)
    {
        //
    }
}
