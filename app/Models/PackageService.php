<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PackageService extends Model
{
    use HasFactory;

    protected $table = 'package_services';

    protected $fillable = [
        'name',
        'description',
    ];

    public string $name;
    public string $description;

    /**
     * @param string $name
     * @param string $description
     */
//    public function __construct(string $name, string $description)
//    {
//        $this->name = $name;
//        $this->description = $description;
//    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    public function allServices()
    {
        return $servicesOfPackage = DB::table('api_service_package_services')->where('package_id', $this->id)->get();
    }

    public function addServiceToPackage($serviceID)
    {

    }

    public function addServicesToPackage(array $serviceID)
    {

    }

    public function deleteServiceFromPackage($serviceID)
    {

    }

    public function deleteServicesFromPackage(array $serviceID)
    {

    }

}
