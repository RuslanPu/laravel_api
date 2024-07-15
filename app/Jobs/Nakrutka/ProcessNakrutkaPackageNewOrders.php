<?php

namespace App\Jobs\Nakrutka;

use App\Models\User;
use App\Models\UserPackage;
use App\Services\Errors\Error;
use App\Services\NakrutkaAPI;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function Laravel\Prompts\select;

class ProcessNakrutkaPackageNewOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public UserPackage $userPackage
    ){
        $this->afterCommit()->onQueue('process-new-order-user-package-' . $this->userPackage->id);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiService = new NakrutkaAPI(new Client());

        $this->userPackage
            ->packageServicesApiServices
            ?->map(function ($packageServicesApiService) {

            });

        try {

        } catch (\Exception $e) {
            Error::notificate(
                'ProcessNakrutkaPackageNewOrders',
                $e->getMessage(),
                $e->getTraceAsString(),
                User::Admin()->email,
            );
        }
    }

    /**
     * @return void
     */
    public function restart(): void
    {
        self::dispatch($this->userPackage)->delay(86400);
    }
}
