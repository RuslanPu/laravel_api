<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Fields
 * @property int $id
 * @property int $package_id
 * @property int $service_id
 * @property int $quantity
 * @property string $comments
 * @property string $username
 *
 * Related
 * @property ApiService $service
 * @property PackageService $package
 */
class PackageServicesApiServices extends Model
{
    use HasFactory;

    protected $table = 'package_services_api_services';

    protected $fillable = [
        'package_id',
        'service_id',
        'quantity',
        'comments',
        'username'
    ];

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(ApiService::class, 'service_id');
    }

    /**
     * @return BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(PackageService::class, 'package_id');
    }

}
