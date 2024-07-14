<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
     * @return BelongsToMany
     */
    public function userPackages(): BelongsToMany
    {
        return $this->belongsToMany(PackageService::class, 'users_packages', 'user_id', 'package_id');
    }

    /**
     * @return BelongsToMany
     */
    public function managerPackages(): BelongsToMany
    {
        return $this->belongsToMany(PackageService::class, 'managers_packages', 'manager_id', 'package_id');
    }

}
