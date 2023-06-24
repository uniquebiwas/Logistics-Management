<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManifestExport implements FromView
{
    public $shipment, $manifest;
    public function __construct($shipment, $manifest)
    {
        $this->shipment = $shipment;
        $this->manifest = $manifest;
    }
    public function view(): View
    {
        return view('exports.manifest', [
            'manifest' => $this->manifest,
            'shipments' => $this->shipment,
        ]);
    }

    





}
