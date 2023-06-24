<?php

namespace App\Exports;

use App\Models\Credit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class ShipmentZoneExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Credit::where('id', 0)->get();
    }
    public function headings(): array
    {
        return [
            'weight',
            'price',
        ];
    }
    public function map($shipment): array
    {
        return [];
    }
}
