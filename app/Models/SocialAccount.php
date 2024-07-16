<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $social_account_type_id
 * @property string $account_link
 */
class SocialAccount extends Model
{
    use HasFactory;

    protected $table = 'social_accounts';

    protected $fillable = [
        'id',
        'user_id',
        'social_account_type_id',
        'account_link'
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(SocialAccountType::class, 'social_account_type_id');
    }

    /**
     * @return HasMany
     */
    public function publicationsLinks(): HasMany
    {
        return $this->hasMany(SocialAccountPublicationsLinks::class, 'social_account_id');
    }

}
