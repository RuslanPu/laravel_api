<?php

namespace App\Jobs\Nakrutka;

use App\Models\UserPackage;
use App\Services\NakrutkaAPI;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNakrutkaPackageNewOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public UserPackage $userPackage,
        public NakrutkaAPI $apiService
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
