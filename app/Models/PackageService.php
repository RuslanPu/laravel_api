<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;

class PackageService extends Model
{
    use HasFactory;

    protected $table = 'package_services';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Связь многие ко многим с ApiService
     *
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(ApiService::class, 'package_services_api_services', 'package_id', 'service_id');
    }

    /**
     * @return Collection
     */
    public function allServices(): Collection
    {
        return $this->services()->get();
    }

    /**
     * @param $serviceID
     * @return void
     */
    public function addServiceToPackage($serviceID): void
    {
        $this->services()->attach($serviceID);
    }

    /**
     * @param array $serviceIDs
     * @return void
     */
    public function addServicesToPackage(array $serviceIDs): void
    {
        $this->services()->attach($serviceIDs);
    }

    /**
     * @param $serviceID
     * @return int
     */
    public function deleteServiceFromPackage($serviceID): int
    {
        return $this->services()->detach($serviceID);
    }

    /**
     * @param array $serviceIDs
     * @return int
     */
    public function deleteServicesFromPackage(array $serviceIDs): int
    {
        return $this->services()->detach($serviceIDs);
    }

    /**
     * Получить всех пользователей, использующих данный пакет.
     *
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,               // Конечная модель, которую мы хотим получить
            UserPackage::class,        // Промежуточная модель
            'package_id',              // Внешний ключ в таблице UserPackage
            'id',                      // Внешний ключ в таблице Users
            'id',                      // Локальный ключ в таблице PackageService
            'user_id'                  // Локальный ключ в таблице UserPackage
        );
    }

    /**
     * @return BelongsToMany
     */
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'manager_packages', 'package_id', 'manager_id');
    }

    /**
     * Связь один ко многим с UserPackages
     *
     * @return HasMany
     */
    public function userPackages(): HasMany
    {
        return $this->hasMany(UserPackage::class, 'package_id');
    }

    /**
     * Связь один ко многим с ManagerPackages
     *
     * @return HasMany
     */
    public function managerPackages(): HasMany
    {
        return $this->hasMany(ManagerPackage::class, 'package_id');
    }

}
