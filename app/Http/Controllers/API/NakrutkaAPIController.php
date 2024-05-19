<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\NakrutkaAPI;

class NakrtutkaAPIController extends Controller
{
    protected $apiService;

    public function __construct(NakrutkaAPI $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->makeAPIRequest();
    }
}
