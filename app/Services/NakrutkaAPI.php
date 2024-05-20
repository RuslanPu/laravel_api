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
}
