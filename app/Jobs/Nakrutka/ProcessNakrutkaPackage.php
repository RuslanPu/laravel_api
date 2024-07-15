<?php

namespace App\Jobs\Nakrutka;

use App\Models\UserPackage;
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
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {

    }
}
