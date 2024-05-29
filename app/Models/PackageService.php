<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function apiServices()
    {
        return $this->belongsToMany('App\Models\ApiService', 'api_service_package_services', 'service_id', 'package_id');
    }
}
