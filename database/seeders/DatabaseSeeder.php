<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserTypeSeeder::class);
        $this->Call(CountrySeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(AppSettingSeeder::class);
        $this->call(AdvertisementPositionSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SmsSeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(StatusLevelSeeder::class);
    }
}
