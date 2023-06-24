<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class NationalManifestExport implements FromView
{
    public $shipment, $manifest;
    public function __construct($shipment, $manifest)
    {
        $this->shipment = $shipment;
        $this->manifest = $manifest;
    }
    public function view(): View
    {
        return view('exports.nationalmanifest', [
            'manifest' => $this->manifest,
            'shipments' => $this->shipment,
        ]);
    }
}
