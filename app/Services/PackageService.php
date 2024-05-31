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

    public function deletePackageByID($packageID){
        $this->repository->deletePackageByID($packageID);
    }

    public function addService($serviceID, $packageID)
    {
        $this->repository->addServiceToPackageID($serviceID, $packageID);
    }

    public function deleteServiceFromPackage($serviceID, $packageID):void
    {
        $this->repository->deleteServiceFromPackage($serviceID, $packageID);
    }

    public function addServicesToPackage(array $serviceID)
    {

    }

    public function getServicesFromPackageID($packageID):array
    {
        return $this->repository->getServicesByPackageId($packageID);
    }

    public function deleteServicesFromPackage(array $serviceID)
    {

    }

}
