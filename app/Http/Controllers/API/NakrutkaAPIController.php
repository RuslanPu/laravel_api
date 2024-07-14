<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApiService;
use App\Models\PackageService;
use App\Services\NakrutkaAPI;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\FlareClient\Api;


class NakrutkaAPIController extends Controller
{
    protected $apiService;

    public function __construct(NakrutkaAPI $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @return string
     */
    public function balance(): string
    {
        return $this->apiService->balance();
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function listServices(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $services = ApiService::all();
        return view('admin.services', compact('services'));
    }

    /**
     * @return mixed
     * @throws \JsonException
     */
    public function statusOrder(): mixed
    {
        $orderID = '427580921';
        $response = $this->apiService->statusOrder($orderID);
        return json_decode($response, false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return mixed
     */
    public function statusMultiOrder(): mixed
    {
        $orderIDs = ['426882755', '426881817', '426596403', '426596256'];
        $response = $this->apiService->statusMultiOrder($orderIDs);
        return json_decode($response, false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return mixed
     * @throws \JsonException
     */
    public function addOrderFollowers(): mixed
    {
        $service_id = '5';
        $quantity = '50';
        $linkProfile  = 'https://www.instagram.com/puninruslan/';
        $response = $this->apiService->addOrderFollowers($service_id, $quantity, $linkProfile);
        return json_decode($response, false, 512, JSON_THROW_ON_ERROR);
    }
    //{"order":"427580921","charge":0.045}

    /**
     * @return mixed
     */
    public function cancelOrder(): mixed
    {
        $order_id = '427580921';
        $response = $this->apiService->cancelOrder($order_id);
        return json_decode($response);

    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function addAllServiceApiToDb(): void
    {
        $response = $this->apiService->listServices();
        $services = json_decode($response, false, 512, JSON_THROW_ON_ERROR);

        foreach($services as $service){
            $apiService = new ApiService();
            $apiService->service = $service->service;
            $apiService->name = $service->name ?? '-';
            $apiService->type = $service->type ?? '-';
            if (isset($service->refill) && $service->refill != null) {
                $apiService->refill = $service->refill;
            } else {
                {
                    $apiService->refill = '-';
                }
            }

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
