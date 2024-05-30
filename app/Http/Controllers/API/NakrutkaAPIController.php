<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApiService;
use App\Models\PackageService;
use App\Services\NakrutkaAPI;
use Exception;
use Spatie\FlareClient\Api;


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
        $services = ApiService::all();
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

    public function addAllServiceApiToDb()
    {
        $response = $this->apiService->listServices();
        $services = json_decode($response);

        foreach($services as $service){
            $apiService = new ApiService();
            $apiService->id_service = $service->service;
            $apiService->name = $service->name ?? '-';
            $apiService->type = $service->type ?? '-';
            if (isset($service->refill) && $service->refill != null) {
                $apiService->refill = $service->refill;
            } else $apiService->refill = '-';

            $apiService->category = $service->category ?? '-';
            $apiService->rate = $service->rate ?? '-';
            $apiService->min = $service->min ?? '-';
            $apiService->max = $service->max ?? '-';
            $apiService->drops = $service->drops ?? '-';
            $apiService->speed_per_hour = $service->speed_per_hour ?? '-';
            $apiService->max_done_count_day = $service->max_done_count_day ?? '-';
            $apiService->limit = $service->limit ?? '-';
            $apiService->queue_time_minutes = $service->queue_time_minutes ?? '-';
            $apiService->cancel = $service->cancel ?? '-';
            $apiService->save();
        }

        echo "All services from API successfully added to DB";
    }

    public function package()
    {

    }




}
