<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property int $package_id
 * @property int $user_id
 * @property int $social_account_id
 * @property boolean $valid
 * @property string|null $finish_date_time
 *
 * Related
 * @property PackageService $package
 * @property SocialAccount $account
 * @property User $user
 * @property ApiService $service
 * @property PackageServicesApiServices $packageServicesApiServices
 */
class UserPackage extends Model
{
    use HasFactory;

    protected $table = 'user_packages';

    public $fillable = [
        'package_id',
        'user_id',
        'social_account_id',
        'valid',
        'finish_date_time',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(PackageService::class, 'package_id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(SocialAccount::class, 'social_account_id');
    }

    /**
     * Get all services for the user package through the package.
     *
     * @return HasManyThrough
     */
    public function packageServicesApiServices(): HasManyThrough
    {
        return $this->hasManyThrough(
            PackageServicesApiServices::class,   // Конечная модель, которую мы хотим получить
            PackageService::class,               // Промежуточная модель
            'id',                                // Внешний ключ в таблице PackageService (локальный ключ в промежуточной модели)
            'package_id',                        // Внешний ключ в таблице PackageServicesApiServices (локальный ключ в конечной модели)
            'package_id',                        // Локальный ключ в таблице UserPackage (локальный ключ в начальной модели)
            'id'                                 // Локальный ключ в таблице PackageService (внешний ключ в промежуточной модели)
        )->where('package_services.active', true);
    }

    /**
     * Get all services for the user package through the package.
     *
     * @return HasManyThrough
     */
    public function apiServices(): HasManyThrough
    {
        return $this->hasManyThrough(
            ApiService::class,
            PackageServicesApiServices::class,
            'package_id', // Foreign key on PackageServicesApiServices table
            'id', // Foreign key on ApiService table
            'package_id', // Local key on UserPackage table
            'service_id' // Local key on PackageServicesApiServices table
        );
    }

}
