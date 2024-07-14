<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ApiService extends Model
{
    use HasFactory;

    protected $table = 'api_services';

    protected $fillable = [
        'id',
        'service',
        'name',
        'type',
        'refill',
        'category',
        'rate',
        'min',
        'max',
        'drops',
        'speed_per_hour',
        'max_done_count_day',
        'limit',
        'queue_time_minutes',
        'cancel',
        'available'
    ];

    /**
     * Связь многие ко многим с PackageService
     *
     * @return BelongsToMany
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(PackageService::class, 'package_services_api_services', 'service_id', 'package_id');
    }

}
