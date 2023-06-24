<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\ShipmentCharge;
use Illuminate\Http\Request;

class PerformaController extends Controller
{
    public function performa($id)
    {
         $performa = ShipmentPackage::with('getSender','getReceiver')->findorfail($id);
        return view('admin.shipmentpackage.performa')
        ->with('performa',$performa)
        ->with('charge',new ShipmentCharge());

    }
}
