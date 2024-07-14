<?php

namespace App\Console\Commands\Nakrutka;

use App\Models\ApiService;
use App\Services\NakrutkaAPI;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class SyncServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize services from JSON';

    /**
     * Execute the console command.
     * @throws \JsonException|GuzzleException
     */
    public function handle(NakrutkaAPI $apiService): void
    {
        try {
            $services = json_decode($apiService->listServices(), true, 512, JSON_THROW_ON_ERROR);

            $serviceIds = collect($services)->pluck('service')->all();

            foreach ($services as $item) {
                ApiService::updateOrCreate(
                    ['service' => $item['service']],
                    $item
                );
            }

            ApiService::whereNotIn('service', $serviceIds)->update(['available' => false]);

            $this->info('Services synchronized successfully');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
