<?php

namespace App\Imports;

use App\Models\Country;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ServiceAgentCountryImport implements ToCollection, WithHeadingRow
{
    public function __construct($serviceAgent)
    {
        $this->service_agent = $serviceAgent;
        $this->zonalData = [];
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $country = DB::table('countries')->get();
        $zones = DB::table('shipment_zones')->where('serviceAgentId', $this->service_agent)->get();
        $now = now();
        foreach ($collection as $key => $zone) {
            if (!$zone['zone']) {
                continue;
            }
            $iso = $zone['code'];
            $countryId = optional($country->firstWhere('iso_2', $iso))->id;

            if ($zones->firstWhere('position', 'like', $zone['zone']) == null) {
                dd($zone);
            }
            DB::table('zone_country_service_agents')->updateOrInsert(
                ['country_id' => $countryId, 'serviceagent_id' => $this->service_agent],
                [
                    'serviceagent_id' => $this->service_agent,
                    'country_id' => $countryId,
                    'zone_id' => $zone['zone'] == 'NA' ? null :  $zones->firstWhere('position', 'like', $zone['zone'])->id,
                    'created_at' => $now,
                ],

            );
        }
    }
}
