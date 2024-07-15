<?php

namespace App\Http\Controllers\AdminPanel\Manager;

use App\Http\Controllers\Controller;
use App\Jobs\Nakrutka\ProcessNakrutkaPackage;
use App\Models\UserPackage;
use Illuminate\Http\RedirectResponse;

class NakrutkaServicesController extends Controller
{
    /**
     * @param UserPackage $userPackage
     * @return RedirectResponse
     */
    public function start(UserPackage $userPackage): RedirectResponse
    {
        $userPackage->valid = true;
        $userPackage->save();

        ProcessNakrutkaPackage::dispatch($userPackage);

        return redirect()->route('manager-users.list')->with('success', 'Package started successfully.');
    }

    /**
     * @param UserPackage $userPackage
     * @return RedirectResponse
     */
    public function stop(UserPackage $userPackage): RedirectResponse
    {
        $userPackage->valid = false;
        $userPackage->save();

        return redirect()->route('manager-users.list')->with('success', 'Package stop is successfully.');
    }

}
