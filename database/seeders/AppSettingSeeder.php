<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AppSettingSeeder extends Seeder
{
    public function run()
    {

        $data = [
            "id" => 1,
            "name" => 'Air Logistics Group',
            "address" => "Gairidhara, Kathmandu, Nepal",
            "phone" => json_encode([
                [
                    'phone_number' => 01 - 4004795,
                    'contact_city' => "Kathmandu, Nepal"
                ],
                [
                    'phone_number' => 9851054349,
                    'contact_city' => "Kathmandu, Nepal"
                ]
            ]),
            "email" => "info@algexpress.com",
            "logo" => "",
            "website_content_format" => "Nepali",
            "registration_date" => '2021-09-09',
            "registration_number" => " ७४/०७३/७४",
            "website_content_item" => json_encode([
                'news', 'user', 'reporter', 'advertisement', 'team', 'video', 'subscriber', 'mediaLibrary'
            ]),
        ];
        DB::table('app_settings')->updateOrInsert($data);
    }
}
