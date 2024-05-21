<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cron extends Model
{
    protected $table = 'crons';

    protected $fillable = [
        'name',
        'value',
    ];

}
