<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NakrutkaOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_package_id',
        'service',
        'order',
        'quantity',
        'link',
        'charge',
        'remains',
        'status',
        'start_count',
        'cancel_info',
        'currency',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function userPackage(): BelongsTo
    {
        return $this->belongsTo(UserPackage::class);
    }

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(ApiService::class, 'service');
    }

}
