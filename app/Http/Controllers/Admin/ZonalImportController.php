<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ServiceAgentCountryImport;
use App\Models\ServiceAgent;
use App\Models\ShipmentZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class ZonalImportController extends Controller
{
    public function zonalImport(Request $request)
    {
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $title = 'Add New Shipment Relation';
        $data = [
            'title' => $title,
            'serviceAgents' => $serviceAgents,
        ];
        return view('admin/zonaldata/import', $data);
    }


    public function zonalImportStore(Request $request)
    {
        $data = Validator::make($request->all(), [
            'serviceagent_id' => 'required|numeric|exists:service_agents,id',
            'excelFile' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp'
        ])->validated();
        DB::beginTransaction();
        try {
            Excel::import(new ServiceAgentCountryImport($data['serviceagent_id']), $data['excelFile']);
            DB::commit();
            request()->session()->flash('success', 'Excel Imported successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }
    public function export()
    {
        $file = public_path('excel/serviceableCountry.xlsx');
        return Response::download($file);
    }
}
