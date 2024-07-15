<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialAccountPublicationsLinks extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_account_id',
        'user_package_id',
        'publication_link',
    ];

    /**
     * @return BelongsTo
     */
    public function socialAccount(): BelongsTo
    {
        return $this->belongsTo(SocialAccount::class);
    }

    /**
     * @return BelongsTo
     */
    public function userPackage(): BelongsTo
    {
        return $this->belongsTo(UserPackage::class);
    }

}
