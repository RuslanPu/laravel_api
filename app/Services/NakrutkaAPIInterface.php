<?php

namespace App\Services;

interface NakrutkaAPIInterface
{
    public function balance();
    public function listOfService();
    public function addOrder();
    public function addMultiOrder();
    public function statusOrder();
    public function statusMultiOrder();
    public function cancelOrder();
    public function cancelMultiOrder();
    public function refillOrder();



}
