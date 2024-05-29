<?php

namespace App\Http\Controllers;

use PackageService;

class PackageServiceApiController
{
    public function listServicesOfPackage()
    {
        $packages = PackageService::find(1);
        $servicesOfPackage = $packages->services();
    }
}
