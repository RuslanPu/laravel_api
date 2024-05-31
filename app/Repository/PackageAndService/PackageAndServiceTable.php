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



    function deleteServiceFromPackage($serviceID, $packageID):void
    {
        $this->table->where('package_id', '=', $packageID)
            ->where('service_id', '=', $serviceID)
            ->delete();
    }

    function deletePackageByID($packageID):void
    {
        $this->table->where('package_id', '=', $packageID)->delete();
    }

    function getServicesByPackageId($packageID): array
    {
        return $this->table
            ->select('service_id')
            ->where('package_id', '=', $packageID)
            ->get()
            ->toArray();
    }
}
