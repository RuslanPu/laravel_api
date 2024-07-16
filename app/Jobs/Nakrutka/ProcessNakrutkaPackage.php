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

class ProcessNakrutkaPackage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public UserPackage $userPackage)
    {
        $this->onQueue('process-nakrutka-user-package-' . $userPackage->id);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if ($this->userPackage->valid) {
                $nakrutkaAPI = new NakrutkaAPI(new Client());

                $this->userPackage
                    ->packageServicesApiServices
                    ?->map(function ($packageServicesApiService) use (&$nakrutkaAPI) {
                        ProcessNakrutkaPackageNewOrders::dispatch($this->userPackage, $packageServicesApiService, $nakrutkaAPI);
                    });
            }
        } catch (\Exception $e) {
            Error::notificate(
                'ProcessNakrutkaPackage',
                $e->getMessage(),
                $e->getTraceAsString(),
                User::Admin()->email,
            );
        }
    }
}
