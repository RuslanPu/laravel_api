<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Related
 * @property SocialAccount|null $account
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAdmin($query): mixed
    {
        return $query->where('type', 2)->first();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeManagers($query): mixed
    {
        return $query->where('type', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeClients($query): mixed
    {
        return $query->where('type', 0);
    }

    /**
     * @return BelongsToMany
     */
    public function clientPackages(): BelongsToMany
    {
        return $this->belongsToMany(PackageService::class, 'user_packages', 'user_id', 'package_id');
    }

    /**
     * @return BelongsToMany
     */
    public function managerPackages(): BelongsToMany
    {
        return $this->belongsToMany(PackageService::class, 'manager_packages', 'manager_id', 'package_id');
    }

    /**
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'manager_clients', 'manager_id', 'user_id');
    }

    /**
     * @return HasMany
     */
    public function userPackage(): HasMany
    {
        return $this->hasMany(UserPackage::class, 'user_id', 'package_id');
    }

    /**
     * @return BelongsTo
     */
    public function managerClient(): BelongsTo
    {
        return $this->belongsTo(ManagerClient::class, 'user_id');
    }

    /**
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(SocialAccount::class, 'user_id');
    }

}
