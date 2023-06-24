<?php

namespace App\Imports;

use App\Models\WeightPrice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ZonePriceImport implements ToCollection
{
    public function __construct($pricings, $serviceAgentId)
    {
        $this->pricings = $pricings;
        $this->serviceAgentId = $serviceAgentId;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $created_at = now();
        foreach ($collection->skip(1) as $row) {
            if (strpos($row[0], '-')) {
                $range = explode("-", $row[0]);
                for ($j = (int) $range[0]; $j <= (int) $range[1]; $j++) {
                    foreach ($this->pricings as $key => $value) {
                        $data[] = [
                            'created_at' => $created_at,
                            'weight' => $j,
                            'pricing_id'  => $this->pricings[$key],
                            'price' => $row[$key + 1] * $j,
                        ];
                    }
                    WeightPrice::insert($data);
                    $data = array();
                }
            } else {
                foreach ($this->pricings as $key => $value) {
                    $data[] = [
                        'created_at' => $created_at,
                        'weight' => $row[0],
                        'pricing_id'  => $this->pricings[$key],
                        'price' => $row[$key + 1],
                    ];
                }
                WeightPrice::insert($data);
                $data = array();
            }
        }
    }
}
