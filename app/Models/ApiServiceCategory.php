<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApiServiceCategory extends Model
{
    use HasFactory;

    protected $table = 'api_service_categories';

    protected $fillable = [
        'id',
        'title'
    ];

    /**
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(ApiService::class, 'category');
    }
}
