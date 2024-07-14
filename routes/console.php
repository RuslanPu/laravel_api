<?php

use App\Console\Commands\FetchBalanceCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

//Commands
Schedule::command('fetch:balance')->everyMinute();
Schedule::command('sync:services')->daily();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


