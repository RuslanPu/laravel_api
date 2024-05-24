<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiService extends Model
{
    protected $table = 'api_services';

    protected $fillable = [
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
}
