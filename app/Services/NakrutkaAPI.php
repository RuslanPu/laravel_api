<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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

    /**
     * @return string
     * @throws GuzzleException
     */
    public function balance(): string
    {
        $action = 'balance';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action);
        return $response->getBody()->getContents();
    }

    /**
     * @return string
     * @throws GuzzleException
     */
    public function listServices(): string
    {
        $action = 'services';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action);
        return $response->getBody()->getContents();
    }

    /**
     * Add a new order
     *
     * @param string $service_id
     * @param int $quantity
     * @param string $linkProfile
     * @param string|null $comments
     * @param string|null $loginAuthorComment
     * @return string
     * @throws GuzzleException
     */
    public function addOrder(
        string      $service_id,
        int         $quantity,
        string      $link,
        string|null $comments = null,
        string|null $loginAuthorComment = null
    ): string
    {
        $action = 'create';

        $params = '&action=' . $action . '&service=' . $service_id;
        if ($quantity) {
            $params .= '&quantity=' . $quantity;
        }

        if ($comments) {
            $params .= '&comments=' . $comments;
        }

        if ($loginAuthorComment) {
            $params .= '&username=' . $comments;
        }

        $params .= '&link=' . $link;

        $response = $this->client->get($this->fullUrlRequest . $params);
        return $response->getBody()->getContents();
    }

    /**
     * @param $orderID
     * @return string
     * @throws GuzzleException
     */
    public function statusOrder($orderID): string
    {
        $action = 'status';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&order=' .$orderID);
        return $response->getBody()->getContents();
    }

    /**
     * @param array $orderIDs
     * @return string
     * @throws GuzzleException
     */
    public function statusMultiOrder(array $orderIDs): string
    {
        $action = 'status';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&orders=' .implode(',', $orderIDs));
        return $response->getBody()->getContents();
    }

    /**
     * @param $orderID
     * @return string
     * @throws GuzzleException
     */
    public function cancelOrder($orderID){
        $action = 'cancel';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&order=' . $orderID);
        return $response->getBody()->getContents();
    }

    /**
     * @param $service_id
     * @param $quantity
     * @param $linkProfile
     * @return string
     * @throws GuzzleException
     */
    public function addOrderFollowers($service_id, $quantity, $linkProfile): string
    {
        $action = 'create';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action .'&service=' . $service_id . '&quantity=' .$quantity . '&link=' . $linkProfile);
        return $response->getBody()->getContents();
    }

    /**
     * @param $service_id
     * @param $quantity
     * @param $link
     * @return void
     * @throws GuzzleException
     */
    public function addOrderLikes($service_id, $quantity, $link): void
    {
        $action = 'create';
        $response = $this->client->get($this->fullUrlRequest . '&action=' . $action . '&service=' . $service_id . '&quantity=' . $quantity . '&link=' . $link);
    }


}
