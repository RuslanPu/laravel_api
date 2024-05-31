<?php

namespace App\Repository\PackageAndService;

use Illuminate\Support\Facades\DB;

class PackageAndServiceTable implements PackageAndServiceInterface
{

    protected $table;

    public function __construct(DB $db)
    {
        $this->table = $db::table('api_service_package_services');
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
        $this->table->where('package_id', '=', $packageID)->delete();
    }

    function getServicesByPackageId($packageID)
    {
        // TODO: Implement getServicesByPackageId() method.
    }
}
