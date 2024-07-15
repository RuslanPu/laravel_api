<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userObj = new User();
        $userObj->name = 'User Rafi';
        $userObj->email = 'userRafi@gmail.com';
        $userObj->password = Hash::make('123456789');
        $userObj->type = 0;
        $userObj->save();

        $managerObj = new User();
        $managerObj->name = 'Manager Rafi';
        $managerObj->email = 'managerRafi@gmail.com';
        $managerObj->password = Hash::make('12356789');
        $managerObj->type = 1;
        $managerObj->save();

        $adminObj = new User();
        $adminObj->name = 'Admin Rafi';
        $adminObj->email = 'adminRafi@gmail.com';
        $adminObj->password = Hash::make('123456789');
        $adminObj->type = 2;
        $adminObj->save();


    }
}
