<?php

namespace App\Console\Commands;

use App\Models\Cron;
use App\Services\NakrutkaAPI;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchBalanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(NakrutkaAPI $apiService)
    {
        info("Cron job running at == " . now());
        $response = $apiService->balance();
        $balance = json_decode($response)->balance;
        $cron = new Cron();
        $cron->name = 'fetch balance';
        $cron->value = $balance;
        $cron->save();
        info("Balance fetched successfully. Balance == " . $balance);
    }
}
