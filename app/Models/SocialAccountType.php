<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccountType extends Model
{
    use HasFactory;

    protected $table = 'social_account_types';

    protected $fillable = [
        'name_social_network'
    ];

    public const INSTAGRAM = 1, FACEBOOK = 2;

}
