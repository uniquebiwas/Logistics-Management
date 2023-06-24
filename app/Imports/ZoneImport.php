<?php

namespace App\Imports;

use App\Models\WeightPrice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZoneImport implements ToCollection, WithHeadingRow
{
    public function __construct($pricings)
    {
        $this->pricings = $pricings;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if (strpos($row['weight'], '-')) {
                $range = explode("-",$row['weight']);
                for($i= (int) $range[0]; $i<= (int) $range[1]; $i++){
                    $weight = $i;
                    $created_at = now();
                    $data = [
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[0],
                            'price' => $row['zone_1'] * $i ?? $row['a'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[1] ,
                            'price' => $row['zone_2']  * $i ?? $row['b'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[2] ,
                            'price' => $row['zone_3'] * $i?? $row['c'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[3] ,
                            'price' => $row['zone_2'] * $i ?? $row['d'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[4] ,
                            'price' => $row['zone_4'] * $i ?? $row['e'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[5] ,
                            'price' => $row['zone_5'] * $i?? $row['f'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[6] ,
                            'price' => $row['zone_6'] * $i ?? $row['g'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[7] ,
                            'price' => $row['zone_7'] * $i ?? $row['h'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[8] ,
                            'price' => $row['zone_8'] * $i ?? $row['i'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[9] ,
                            'price' => $row['zone_9'] * $i ?? $row['j'] * $i,
                        ],

                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[10] ,
                            'price' => $row['zone_10'] * $i ?? $row['k'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[11] ,
                            'price' => $row['zone_11'] * $i ?? $row['l'] * $i,
                        ],
                        [
                            'created_at' => $created_at,
                            'weight' => $weight,
                            'pricing_id'  => $this->pricings[12] ,
                            'price' => $row['zone_13'] * $i ?? $row['m'] * $i ?? null
                        ],
                    ];
                    WeightPrice::insert($data);
                    $data = array();
                }


            }
            else{
            $weight = $row['weight'] ?? $row['weight_kg'];
            $created_at = now();
            $data = [
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[0],
                    'price' => $row['zone_1'] ?? $row['a'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[1],
                    'price' => $row['zone_2'] ?? $row['b'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[2],
                    'price' => $row['zone_3'] ?? $row['c'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[3],
                    'price' => $row['zone_2'] ?? $row['d'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[4],
                    'price' => $row['zone_4'] ?? $row['e'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[5],
                    'price' => $row['zone_5'] ?? $row['f'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[6],
                    'price' => $row['zone_6'] ?? $row['g'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[7],
                    'price' => $row['zone_7'] ?? $row['h'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[8],
                    'price' => $row['zone_8'] ?? $row['i'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[9],
                    'price' => $row['zone_9'] ?? $row['j'],
                ],

                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[10],
                    'price' => $row['zone_10'] ?? $row['k'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[11],
                    'price' => $row['zone_11'] ?? $row['l'],
                ],
                [
                    'created_at' => $created_at,
                    'weight' => $weight,
                    'pricing_id'  => $this->pricings[12],
                    'price' => $row['zone_13'] ?? $row['m'] ?? null
                ],
            ];
        }
        // dd($data);
            WeightPrice::insert($data);
            $data = array();
        }
    }
}
