<?php

namespace Database\Seeders;

use App\Models\ManagerClient;
use App\Models\ManagerPackage;
use App\Models\PackageService;
use App\Models\PackageServicesApiServices;
use App\Models\SocialAccount;
use App\Models\UserPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SocialAccountTypeSeeder::class
        ]);

        PackageService::factory(3)->create(); //Создаем пакеты
        Artisan::call('sync:services'); //Получаем услуги
        PackageServicesApiServices::factory(15)->create(); //Добавляем пакетам услуги
        ManagerPackage::factory(2)->create(); //Даем разрешение менеджеру пользоваться пакетам
        ManagerClient::factory()->create();//Выдем менеджеру клиента
        SocialAccount::factory(2)->create(); //Создаем Аккаунты пользователю
        UserPackage::factory(3)->create(); //Даем пользователю пакеты
    }
}
