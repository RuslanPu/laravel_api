<?php

namespace App\Console\Commands;

use App\Models\Cron;
use App\Models\User;
use App\Services\Errors\Error;
use App\Services\NakrutkaAPI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use JsonException;

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
     * @throws JsonException|GuzzleException
     */
    public function handle(NakrutkaAPI $apiService): void
    {
        try{
            info("Cron job running at == " . now());
            $response = $apiService->balance();
            $balance = json_decode($response, false, 512, JSON_THROW_ON_ERROR)->balance;
            $cron = new Cron();
            $cron->name = 'fetch balance';
            $cron->value = $balance;
            $cron->save();
            info("Balance fetched successfully. Balance == " . $balance);
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            Error::notificate(
                'SyncServices',
                $e->getMessage(),
                $e->getTraceAsString(),
                User::Admin()->email,
            );
        }
    }
}
