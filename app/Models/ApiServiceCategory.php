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

    public const CATEGORY_FOLLOWERS = 3;
    public const CATEGORY_LIKES = 4;
    public const CATEGORY_VIEWS = 5;
    public const CATEGORY_COMMENTS = 6;
    public const CATEGORY_STATISTICS = 7;

    /**
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(ApiService::class, 'category');
    }
}
