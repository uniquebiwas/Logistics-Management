<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ManifestExport;
use App\Exports\NationalManifestExport;
use App\Http\Controllers\Controller;
use App\Models\Manifest;
use App\Models\NationalManifest;
use App\Models\NationalManifestBag;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use NumberFormatter;

class ManifestExcelExportController extends Controller
{
    public function exportExcel($id)
    {

        $manifest = Manifest::findorfail($id);
        $manifest->load('shipment');
        if ($manifest->shipment->count() == 0) {
            request()->session()->flash('error', 'This manifest has no AWB.');
            return redirect()->back();
        }
        try {
            $export = new ManifestExport($manifest->shipment, $manifest);
            return Excel::download($export, date('d-M-Y') . 'manifest.csv');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function nationalManifestExport($id)
    {

        $manifest = NationalManifest::with('shipment')->findorfail($id);
        if ($manifest->shipment->count() == 0) {
            request()->session()->flash('error', 'This manifest has no AWB.');
            return redirect()->back();
        }
        try {
            $export = new NationalManifestExport($manifest->shipment, $manifest);

            return Excel::download($export, date('d-M-Y') . 'CustomClearance.csv');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
