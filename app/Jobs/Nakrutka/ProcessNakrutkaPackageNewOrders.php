<?php

namespace App\Jobs\Nakrutka;

use App\Models\ApiServiceCategory;
use App\Models\NakrutkaOrders;
use App\Models\PackageServicesApiServices;
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

class ProcessNakrutkaPackageNewOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public UserPackage $userPackage,
        public PackageServicesApiServices $packageServicesApiService,
    ){
        $this->afterCommit()->onQueue('process-new-order-user-package-' . $this->userPackage->id);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->userPackage->package->active
            && $this->userPackage->valid
        ) {
            $nakrutkaAPI = new NakrutkaAPI(new Client());

            $link = null;
            $service = $this->packageServicesApiService->service;

            switch ($service->category) {
                case ApiServiceCategory::CATEGORY_FOLLOWERS:
                    $link = $this->userPackage->account->account_link;
                    break;
                case ApiServiceCategory::CATEGORY_VIEWS:
                case ApiServiceCategory::CATEGORY_COMMENTS:
                case ApiServiceCategory::CATEGORY_STATISTICS:
                case ApiServiceCategory::CATEGORY_LIKES:
                    $link = $this->userPackage->account->publicationsLinks()->inRandomOrder()->first()->publication_link;
                    break;
            }

            $quantity = $this->calculateQuantity(
                $this->packageServicesApiService->quantity,
                $this->packageServicesApiService->service->min,
                $this->packageServicesApiService->service->max,
            );

            $responseData = $nakrutkaAPI->addOrder(
                $this->packageServicesApiService->service->service,
                $quantity,
                $link,
                $this->packageServicesApiService->comments,
                $this->packageServicesApiService->username
            );

            if ($responseData['successes']) {
                $dataOrder = $responseData['data'];

                NakrutkaOrders::create([
                    'user_id' => $this->userPackage->user_id,
                    'user_package_id' => $this->userPackage->id,
                    'service' => $service->id,
                    'order' => $dataOrder['order'],
                    'quantity' => $quantity,
                    'link' => $link,
                    'charge' => $dataOrder['charge']
                    //'remains',
                    //'status',
                    //'start_count',
                    //'cancel_info',
                    //'currency',
                ]);
            } else {
                Error::notificate(
                    'ProcessNakrutkaPackageNewOrders',
                    $responseData['title'],
                    $responseData['content'],
                    User::Admin()->email,
                );
            }
        }

        //try {
//
        //} catch (\Exception $e) {
        //    Error::notificate(
        //        'ProcessNakrutkaPackageNewOrders',
        //        $e->getMessage(),
        //        $e->getTraceAsString(),
        //        User::Admin()->email,
        //    );
        //}
    }


    /**
     * @param int|null $quantityInMonth
     * @param int $minQuantityInOneOrder
     * @param int $maxQuantityInOneOrder
     * @return int|null
     */
    public function calculateQuantity(int|null $quantityInMonth, int $minQuantityInOneOrder, int $maxQuantityInOneOrder): int|null
    {
        if ($quantityInMonth) {
            $quality = $quantityInMonth / 30;
            if ($quality < $minQuantityInOneOrder) {
                $quality = $minQuantityInOneOrder;
            }

            if ($quality > $maxQuantityInOneOrder) {
                $quality = $maxQuantityInOneOrder;
            }

            return ceil($quality);
        }

        return null;
    }

    /**
     * @return void
     */
    public function restart(): void
    {
        self::dispatch($this->userPackage)->delay(86400); //1day 86400
    }
}
