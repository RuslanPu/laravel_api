<?php

namespace App\Repository\PackageAndService;

class PackageAndServiceTable implements PackageAndServiceInterface
{


    function add($packageID, $serviceID, $quantity)
    {
        // TODO: Implement add() method.
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
