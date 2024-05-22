<?php

namespace App\Services;

use GuzzleHttp\Client;
class NakrutkaAPI
{
    protected $client;

    protected $uriApi;

    protected $token;

    protected $fullUrlRequest;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->uriApi = config('services.nakrutka_api.uri');
        $this->token = config('services.nakrutka_api.token');
        $this->fullUrlRequest = $this->uriApi . '?key=' . $this->token;
    }

    public function balance()
    {
        $action = 'balance';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action);
        return $response->getBody()->getContents();
    }

    public function listServices()
    {
        $action = 'services';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action);
        return $response->getBody()->getContents();
    }

    public function addOrder($action, $service_id, $quantity, $linkProfile, $comment, $loginAuthorComment)
    {
        //get response {'order_id', 'charge'}
    }

    public function statusOrder($orderID){
        $action = 'status';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&order=' .$orderID);
        return $response->getBody()->getContents();
    }

    public function statusMultiOrder(array $orderIDs)
    {
        $action = 'status';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&orders=' .implode(',', $orderIDs));
        return $response->getBody()->getContents();
    }

    public function cancelOrder($orderID){
        $action = 'cancel';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&order=' . $orderID);
        return $response->getBody()->getContents();
    }

    public function addOrderFollowers($service_id, $quantity, $linkProfile)
    {
        $action = 'create';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&service=' . $service_id . '&quantity=' .$quantity . '&link=' . $linkProfile);
        return $response->getBody()->getContents();
    }

    public function addOrderLikes($service_id, $quantity, $link)
    {
        $action = 'create';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action . '&service=' . $service_id . '&quantity=' . $quantity . '&link=' . $link);
    }
}
