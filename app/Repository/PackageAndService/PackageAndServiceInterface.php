<?php

namespace App\Repository\PackageAndService;

interface PackageAndServiceInterface
{
    function add($packageID, $serviceID, $quantity);
    function addServiceToPackage($serviceID, $packageID);
    function deleteServiceFromPackage($serviceID, $packageID);

    function deletePackageByID($packageID);
    function getServicesByPackageId($packageID);

}
