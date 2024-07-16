<?php

namespace App\Http\Controllers\AdminPanel\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NakrutkaAPI;
use GuzzleHttp\Client;

class StatisticController extends Controller
{
    public function index()
    {
        /** @var User $client */
        $client = auth()->user();

        $orderIDs = $client->nakrutkaOrders()->pluck('order')?->toArray();

        $data = null;
        $ApiAvailability = false;
        //if ($orderIDs) {
        //    $nakrutkaAPI = new NakrutkaAPI(new Client());
//
        //    $ordersStatuses = $nakrutkaAPI->statusMultiOrder($orderIDs);
//
        //    if ($ordersStatuses['successes']) {
        //        $data = $ordersStatuses['data'];
        //        $ApiAvailability = true;
        //    }
        //}

        return view('client.statistic.index', compact('ApiAvailability', 'data'));
    }
}
