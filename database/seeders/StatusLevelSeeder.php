<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusLevel;

class StatusLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                "id" => 1,
                "title" =>  'PENDING',
                "status" => true,
            ],
            [
                "id" => 2,
                "title" =>  'APPROVED',
                "status" => true,
            ],
            [
                "id" => 3,
                "title" =>  'CANCELLED',
                "status" => true,
            ],
            [
                "id" => 4,
                "title" =>  'RECEIVED',
                "status" => true,
            ],

            [
                "id" => 5,
                "title" =>  'SCHEDULED',
                "status" => true,
            ],
            [
                "id" => 6,
                "title" =>  'DISPATCHED',
                "status" => true,
            ],
            [
                "id" => 7,
                "title" =>  'TRANSIT TO DESTINATION',
                "status" => true,
            ],
            [
                "id" => 8,
                "title" =>  'SHIPMENT ON HOLD',
                "status" => true,
            ],
            [
                "id" => 9,
                "title" =>  'RETURN TO SHIPPER',
                "status" => true,
            ],

            [
                "id" => 10,
                "title" =>  'DELIVERED',
                "status" => true,
            ],






        ];

        foreach ($levels as $levelItem) {
            $level = new StatusLevel();
            if ($level->where('id', $levelItem['id'])->count() > 0) {
                $level = $level->where('id', $levelItem['id'])->first();
            }
            $level->fill($levelItem);
            $level->save();
        }
    }
}
