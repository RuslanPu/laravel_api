<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PackageServicesApiServices extends Model
{
    use HasFactory;

    protected $table = 'package_services_api_services';

    protected $fillable = [
        'package_id',
        'service_id'
    ];

}
