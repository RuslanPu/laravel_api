<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use App\Services\PackageService;
use Mockery\Exception;

class ServiceOfPackageController extends Controller
{
    protected $packageService;

    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function add($packageID, $serviceID, $quantity)
    {
        $this->packageService->addPackage($packageID, $serviceID, $quantity);
    }

    public function deletePackageByID($packageID)
    {
        $this->packageService->deletePackageByID($packageID);
    }

    public function addServiceToPackageID($serviceID, $packageID)
    {
        $this->packageService->addServiceToPackageID($serviceID, $packageID);
    }

    public function deleteServiceFromPackage($serviceID, $packageID): void
    {
        $this->packageService->deleteServiceFromPackage($serviceID, $packageID);
    }

    public function getServicesFromPackageID($packageID):array
    {
        return $this->packageService->getServicesFromPackageID($packageID);
    }



    public function index(){
        try{
            $services = $this->getServicesFromPackageID(1);
            $this->deleteServiceFromPackage(2, 1);

            var_dump($services);
        } catch (Exception $e){
            return "Error , message : " . $e->getMessage();
        }

    }
}
