<?php

namespace App\Http\Controllers;

use App\Models\CargoInvoice;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceCancelController extends Controller
{
    public const  TYPE = ['cargo', 'courier'];
    public function cancelInvoice($id, $type = 1)
    {
        try {
            if ($type == 1) {
                $invoice =   Invoice::where('id', $id)->first();
                $invoice->update(['cancel' => !$invoice->cancel]);
                $invoice->shipmentPackages()->update('invoice', !$invoice->cancel);
            } else {
                $CargoInvoice = CargoInvoice::where('id', $id)->first();
                $CargoInvoice->update(['cancel' => !$CargoInvoice->cancel]);
            }
            request()->session()->flash('success', 'Invoice Cancelled successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }
}
