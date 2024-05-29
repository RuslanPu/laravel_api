<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ApiService extends Model
{
    use HasFactory;

    protected $table = 'api_services';

    protected $fillable = [
        'id',
        'id_service',
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
    ];

    public function packages()
    {
        return $this->belongsToMany(PackageService::class);
    }
}
