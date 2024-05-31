<?php

namespace App\Repository\PackageAndService;

interface PackageAndServiceInterface
{
    function add($packageID, $serviceID, $quantity);
    function deleteServiceFromPackage($serviceID, $packageID);

    function deletePackageByID($packageID);
    function getServicesByPackageId($packageID);

}
