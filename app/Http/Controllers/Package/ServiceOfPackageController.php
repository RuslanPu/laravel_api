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

    public function index(){
        try{
            $this->add(1,1, 900);
            echo "add package successfully!";
        } catch (Exception $e){
            return "Error , message : " . $e->getMessage();
        }

    }
}
