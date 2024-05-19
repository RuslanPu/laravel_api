<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function adminDashboard() {
        $users = User::all();
        return view('admin/adminDashboard', compact('users'));
    }

    public function managerDashboard() {
        return view('manager/managerDashboard');
    }

    public function userDashboard() {
        return view('user/userDashboard');
    }
}
