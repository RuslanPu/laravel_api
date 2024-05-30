<?php

namespace App\Services;

use App\Repository\PackageAndService\PackageAndServiceTable;

class PackageService
{
    protected $repository;

    public function __construct(PackageAndServiceTable $repository)
    {
        $this->repository = $repository;
    }

    public function addPackage($packageID, $serviceID, $quantity)
    {
        $this->repository->add($packageID, $serviceID, $quantity);
    }

    public function addServiceToPackage($serviceID)
    {

    }

    public function addServicesToPackage(array $serviceID)
    {

    }

    public function deleteServiceFromPackage($serviceID)
    {

    }

    public function deleteServicesFromPackage(array $serviceID)
    {

    }

}
