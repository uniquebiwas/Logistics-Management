<?php

namespace Database\Seeders;

use App\Models\SmsSetting;
use Illuminate\Database\Seeder;

class SmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            'api' => 'https://api.sparrowsms.com/v2/sms/',
            'token' => 'v2_0CLF7JXqODRnz1BcmICLisDqvdR.6K2e',
            'identity' => 'infosms',
            'status' => 1,
            // 'creat'
        ];
        SmsSetting::create($data);
    }
}
