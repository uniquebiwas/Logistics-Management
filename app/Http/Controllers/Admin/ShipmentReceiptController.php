<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;
use NumberFormatter;

class ShipmentReceiptController extends Controller
{
    public function getReceipt($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $shipment = ShipmentPackage::with('getServiceAgent')->findorfail($id);
        $pdf = PDF::loadView('admin.shipmentReceipt.receipt', compact('shipment','format'));
        $pdf->setPaper('A3', 'portrait');
        return $pdf->stream('tests.pdf');
    }
}
