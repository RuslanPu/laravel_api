<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $service
 * @property string $name
 * @property string $type
 * @property string $refill
 * @property int $category
 * @property string $rate
 * @property string $min
 * @property string $max
 * @property string $drops
 * @property string $speed_per_hour
 * @property string $max_done_count_day
 * @property string $limit
 * @property string $queue_time_minutes
 * @property string $cancel
 * @property boolean $available
 */
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

    /**
     * @return BelongsTo
     */
    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ApiServiceCategory::class, 'category', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ApiServiceCategory::class, 'category');
    }

}
