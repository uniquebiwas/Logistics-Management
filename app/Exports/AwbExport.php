<?php

namespace App\Exports;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AwbExport implements FromView,WithColumnFormatting
{
    protected $packages;

    public function __construct(array $packages)
    {
        $this->packages = $packages;
    }
    public function getData()
    {
        return DB::table('shipment_packages')
            ->join('agent_profiles', 'agent_profiles.userId', 'shipment_packages.agentId')
            ->whereIn('shipment_packages.id', $this->packages)
            ->select('shipment_packages.*', 'agent_profiles.company_name')
            ->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('exports.awbexport', [
            'shipmentPackages' => $this->getData(),
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'X' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
