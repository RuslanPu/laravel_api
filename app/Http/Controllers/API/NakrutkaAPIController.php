<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\NakrutkaAPI;

class NakrutkaAPIController extends Controller
{
    protected $apiService;

    public function __construct(NakrutkaAPI $apiService)
    {
        $this->apiService = $apiService;
    }

    public function balance()
    {
        $response = $this->apiService->balance();
        return $response;
    }

    public function listServices()
    {
        $response = $this->apiService->listServices();
        $services = json_decode($response);
        return view('admin.services', compact('services'));
    }
}
