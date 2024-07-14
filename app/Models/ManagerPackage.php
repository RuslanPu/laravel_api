<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManagerPackage extends Model
{
    use HasFactory;

    protected $table = 'manager_packages';

    protected $fillable = [
        'package_id',
        'manager_id',
        'is_active'
    ];

    /**
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(PackageService::class, 'package_id');
    }

}
