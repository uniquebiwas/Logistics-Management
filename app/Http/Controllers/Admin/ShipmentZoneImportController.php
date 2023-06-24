<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ShipmentZoneExport;
use App\Imports\ZoneImport;
use App\Imports\ZonePriceImport;
use App\Models\Country;
use App\Models\Pricing;
use App\Models\ServiceAgent;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ShipmentZoneImportController extends Controller
{
    public function index()
    {
        $pricing_info = null;
        $users =  User::select('id', 'name')
            ->with('roles')
            ->with('agent_profile')
            ->get()
            ->filter(function ($user, $key) {
                return $user->hasRole('Agent');
            })
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->agent_profile->company_name];
            });

        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id');
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $title = 'Add New Agent Pricing';
        $data = [
            'title' => $title,
            'pricing_info' => $pricing_info,
            'countries' => $countries,
            'serviceAgents' => $serviceAgents,
            'users' => $users,
        ];
        return view('admin.pricing.excelImport', $data);
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'agent_id' => 'required|array',
            'serviceAgentId' => 'required|numeric|exists:service_agents,id',
            'publishStatus' => 'required|in:0,1',
            'effectiveDate' => 'required|date',
            'excelFile' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp'
        ])->validated();
        DB::beginTransaction();
        $zones = DB::table('shipment_zones')->where('serviceAgentId', $data['serviceAgentId'])->get();
        try {
            foreach ($data['agent_id'] as $key => $agent) {
                foreach ($zones as $zone) {
                    $pricings[] = Pricing::insertGetId([
                        'agent_id' => $agent,
                        'serviceAgentId' => $data['serviceAgentId'],
                        'createdBy' => auth()->id(),
                        'effectiveDate' => $data['effectiveDate'],
                        'zone_id' => $zone->id,
                        'created_at' => now(),
                    ]);
                }
                Excel::import(new ZonePriceImport($pricings, $data['serviceAgentId']), $data['excelFile']);
                $pricings = [];
            }
            DB::commit();
            request()->session()->flash('success', 'The excel File has Been Imported Successfully');
            return redirect()->route('admin.pricing.agent');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
            //throw $th;
        }
    }

    public function export()
    {
        $file = public_path('excel/demo.xlsx');
        return Response::download($file);
    }
}
