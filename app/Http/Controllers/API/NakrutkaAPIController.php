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

    public function statusOrder()
    {
        $orderID = '427580921';
        $response = $this->apiService->statusOrder($orderID);
        return json_decode($response);
    }

    public function statusMultiOrder()
    {
        $orderIDs = ['426882755', '426881817', '426596403', '426596256'];
        $response = $this->apiService->statusMultiOrder($orderIDs);
        return json_decode($response);
    }

    public function addOrderFollowers()
    {
        $service_id = '5';
        $quantity = '50';
        $linkProfile  = 'https://www.instagram.com/puninruslan/';
        $response = $this->apiService->addOrderFollowers($service_id, $quantity, $linkProfile);
        return json_decode($response);
    }
    //{"order":"427580921","charge":0.045}
    public function cancelOrder()
    {
        $order_id = '427580921';
        $response = $this->apiService->cancelOrder($order_id);
        return json_decode($response);

    }




}
