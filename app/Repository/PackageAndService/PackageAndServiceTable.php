<?php

namespace App\Repository\PackageAndService;

use Illuminate\Support\Facades\DB;

class PackageAndServiceTable implements PackageAndServiceInterface
{


    public function __construct()
    {
    }

    function add($packageID, $serviceID, $quantity)
    {
        DB::table('api_service_package_services')->insert([
            'package_id' => $packageID,
            'service_id' => $serviceID,
            'quantity' =>  $quantity
        ]);
    }

    function addServiceToPackage($serviceID, $packageID)
    {
        // TODO: Implement addServiceToPackage() method.
    }

    function deleteServiceFromPackage($serviceID, $packageID)
    {
        // TODO: Implement deleteServiceFromPackage() method.
    }

    function deletePackageByID($packageID)
    {
        // TODO: Implement deletePackageByID() method.
    }

    function getServicesByPackageId($packageID)
    {
        // TODO: Implement getServicesByPackageId() method.
    }
}
