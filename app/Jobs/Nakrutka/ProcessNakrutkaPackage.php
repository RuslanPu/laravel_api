<?php

namespace App\Jobs\Nakrutka;

use App\Models\User;
use App\Models\UserPackage;
use App\Services\Errors\Error;
use App\Services\NakrutkaAPI;
use Carbon\Carbon;
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
        $this->onQueue('process_nakrutka_user_package');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $currentDateTime = Carbon::now();
            $packageDateTime = Carbon::parse($this->userPackage->finish_date_time);
            if ($currentDateTime->greaterThan($packageDateTime)) {
                $this->userPackage->valid = false;
                $this->userPackage->save();
            } else {
                if ($this->userPackage->package->active
                    && $this->userPackage->valid
                ) {
                    $this->userPackage
                        ->packageServicesApiServices
                        ?->map(function ($packageServicesApiService) {
                            ProcessNakrutkaPackageNewOrders::dispatch($this->userPackage, $packageServicesApiService);
                        });
                }
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
