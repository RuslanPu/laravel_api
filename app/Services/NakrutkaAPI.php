<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

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
     * @return array
     * @throws GuzzleException
     */
    public function addOrder(
        string      $service_id,
        int|null         $quantity,
        string      $link,
        string|null $comments = null,
        string|null $loginAuthorComment = null
    ): array
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

        try {
            $response = $this->client->get($this->fullUrlRequest . $params);

            if ($response->getStatusCode() >= 400) {
                return ['successes' => false, 'title' => 'Error response from server', 'content' => $response->getBody()->getContents()];
            }

            $responseData = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            if (isset($responseData['order']) && $responseData['order'] === '406') {
                return ['successes' => false, 'title' => 'Order has been canceled', 'content' => 'Change link'];
            }

            return ['successes' => true, 'data' => $responseData];
        } catch (\Exception $e) {
            // Handle the exception as needed
            return ['successes' => false, 'title' => $e->getMessage(), 'content' => $e->getTraceAsString()];
        }
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
