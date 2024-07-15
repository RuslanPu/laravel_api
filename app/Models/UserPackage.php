<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $package_id
 * @property int $user_id
 * @property int $social_account_id
 * @property boolean $valid
 * @property string|null $finish_date_time
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

}
