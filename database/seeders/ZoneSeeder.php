<?php

namespace Database\Seeders;

use App\Models\ShipmentZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ZoneSeeder extends Seeder
{
    public function getServiceAgent()
    {
        return [
            ['title' => 'DHL'],
            ['title' => 'FEDEX'],
            ['title' => 'UPS'],
        ];
    }

    public function upsZone()
    {
        return [
            'zone-2',
            'zone-3',
            'zone-4',
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('shipment_zones')->truncate();
        DB::table('service_agents')->truncate();
        DB::table('service_agents')->insert($this->getServiceAgent());
        for ($i = 1; $i < 14; $i++) {
            ShipmentZone::create(['title' => 'zone ' . $i, 'serviceAgentId' => 1, 'position' => $i]);
        }
        foreach (range('A', 'L') as $key => $elements) {
            ShipmentZone::create(['title' =>  $elements, 'serviceAgentId' => 2, 'position' => $elements]);
        }
        $upsZone =[
            [
                'title' => 'Zone-2',  
                'serviceAgentId' => 3,
                 'position' => 2
            ],
            [
                'title' => 'Zone-3',  
                'serviceAgentId' => 3,
                 'position' => 3
            ],
            [
                'title' => 'Zone-4',  
                'serviceAgentId' => 3,
                 'position' => 4
            ],
            [
                'title' => 'USA',  
                'serviceAgentId' => 3,
                 'position' => 'USA'
            ],[
                'title' => 'Canada',  
                'serviceAgentId' => 3,
                 'position' => 'Canada'
            ],[
                'title' => 'Hongkong',  
                'serviceAgentId' => 3,
                 'position' => 'Hongkong'
            ],[
                'title' => 'Poland',  
                'serviceAgentId' => 3,
                 'position' => 'Poland'
            ],[
                'title' => 'South Africa',  
                'serviceAgentId' => 3,
                 'position' => 'South Africa'
            ],[
                'title' => 'Belgium',  
                'serviceAgentId' => 3,
                 'position' => 'Belgium'
            ],[
                'title' => 'Netherland',  
                'serviceAgentId' => 3,
                 'position' =>'Netherland'
            ],[
                'title' => 'Germany',  
                'serviceAgentId' => 3,
                 'position' => 'Germany'
            ],[
                'title' => 'France',  
                'serviceAgentId' => 3,
                 'position' => 'France'
            ],[
                'title' => 'UK',  
                'serviceAgentId' => 3,
                 'position' => 'UK'
            ],[
                'title' => 'Italy',  
                'serviceAgentId' => 3,
                 'position' =>'Italy'
            ],[
                'title' => 'Luxembourg',  
                'serviceAgentId' => 3,
                 'position' =>  'Luxembourg'
            ],[
                'title' => 'Ireland',  
                'serviceAgentId' => 3,
                 'position' => 'Ireland'
            ],[
                'title' => 'Spain',  
                'serviceAgentId' => 3,
                 'position' => 'Spain'
            ],
            [
                'title' => 'Portugal',  
                'serviceAgentId' => 3,
                 'position' => 'Portugal'
            ],
        ];
        foreach ($upsZone as $item) {
            $zone = new ShipmentZone();
            $zone->fill($item);
            $zone->save();
        }
        Schema::enableForeignKeyConstraints();
    }
}
