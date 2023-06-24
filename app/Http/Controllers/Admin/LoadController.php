<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Load;
use App\Models\LoadShipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoadController extends Controller
{
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'shipmentId' => ['required', 'array'],
            'shipmentId.*' => ['required', 'exists:shipment_packages,id']
        ]);
        DB::beginTransaction();
        try {
            $load = Load::updateOrCreate(['loadDate' => now()->format('Y-m-d')]);
            $load->shipments()->syncWithoutDetaching($data['shipmentId']);
            DB::commit();
            return response()->json([
                'message' =>  $load->loadDate . ' load created successfully',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' =>  $th->getMessage(),
            ], 500);
        }
    }


    public function deleteLoad($load)
    {
        $loadShipment =   LoadShipment::where('shipmentId', $load)->firstOrFail();
        try {
            $loadShipment->delete();
            request()->session()->flash('success', 'Load deleted successfull');
            return redirect()->back();
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Load Cannot Be deleted');
            return redirect()->back();
        }
    }
}
