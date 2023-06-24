<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ServiceAgent;
use App\Models\ShipmentZone;
use App\Models\ZoneCountryServiceAgent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ZonalController extends Controller
{
    public function __construct(ZoneCountryServiceAgent $zonalData)
    {
        $this->zonalData = $zonalData;
        $this->countries = Country::pluck('name', 'id');
    }

    protected function getzonalData($request)
    {
        $query = $this->zonalData;
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }

    public function index(Request $request)
    {
        $serviceAgents = DB::table('zone_country_service_agents')
            ->join('countries', 'countries.id', 'zone_country_service_agents.country_id')
            ->join('service_agents', 'service_agents.id', 'zone_country_service_agents.serviceagent_id')
            ->join('shipment_zones', 'shipment_zones.id', 'zone_country_service_agents.zone_id')
            ->when($request->agentService, fn ($query) => $query->where('service_agents.id', $request->agentService))
            ->select('countries.name', 'zone_country_service_agents.zone_id', 'shipment_zones.title', 'service_agents.title as servicetitle')
            ->get()
            ->groupBy('title');
        $serviceAgent = ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id');
        return view('admin/zonaldata/index', compact('serviceAgents', 'serviceAgent'));
    }

    public function legacyIndex(Request $request)
    {
        $title = 'Shipment zones';

        // $data = DB::table('zone_country_service_agents')
        //     ->select('zone_id', 'serviceagent_id')
        //     ->distinct('zone_id')
        //     ->distinct('serviceagent_id')
        //     ->get();

        $shipmentDetails = DB::table('zone_country_service_agents')
            ->join('service_agents', 'service_agents.id', 'zone_country_service_agents.serviceagent_id')
            ->join('shipment_zones', 'shipment_zones.id', 'zone_country_service_agents.zone_id')
            ->addSelect(DB::raw('Distinct zone_id,serviceagent_id,shipment_zones.title  as zone,service_agents.title as service,GROUP_CONCAT(country_id) as countries,count(*) as total '))
            ->groupBy(['zone_id', 'serviceagent_id', 'zone',  'service'])
            ->when($request->keyword, function ($qr) use ($request) {
                return $qr->where('shipment_zones.title', 'like', $request->keyword)
                    ->orWhere('service_agents.title', 'like', $request->keyword);
            })
            ->orderBy('zone', 'Asc')
            ->paginate(20);

        // $data = $this->getzonalData($request);
        $data = [
            'title' => $title,
            'data' => $shipmentDetails,
        ];
        return view('admin/zonaldata/list', $data);
    }

    public function create(Request $request)
    {
        $zonalData_info = null;
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $zones = ShipmentZone::where('id', '!=', '1')->where('publishStatus', true)->pluck('title', 'id');
        $title = 'Add New Shipment Relation';
        $data = [
            'zonalData_info' => $zonalData_info,
            'title' => $title,
            'serviceAgents' => $serviceAgents,
            'zones' => $zones,
        ];
        return view('admin/zonaldata/form', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'type' => 'required|in:country,zone',
            'zone_id' => 'nullable|numeric',
            'serviceagent_id' => 'required|numeric',
            'country_id' => 'required',
            'publishStatus' => 'required|in:0,1',
        ]);
        try {
            DB::beginTransaction();
            if ($request->type == 'zone') {
                foreach ($request->country_id as $key => $value) {
                    $data = [
                        'zone_id' => $request->zone_id,
                        'country_id' => $value,
                        'serviceagent_id' => $request->serviceagent_id,
                        'publishStatus' => $request->publishStatus,
                    ];
                    ZoneCountryServiceAgent::create($data);
                }
            } elseif ($request->type == 'country') {
                foreach ($request->country_id as $key => $value) {
                    $data = [
                        'zone_id' => 1,
                        'country_id' => $value,
                        'serviceagent_id' => $request->serviceagent_id,
                        'publishStatus' => $request->publishStatus,
                    ];
                    ZoneCountryServiceAgent::create($data);
                }
            }
            $request->session()->flash('success', 'New Region added successfully.');
            DB::commit();
            return redirect()->route('zonal.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $zonalData_info = $this->zonalData->find($id);
        if (!$zonalData_info) {
            abort(404);
        }
        $title = 'Update Shipment Zone';
        return view('admin/zonalData/form', compact('zonalData_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $zonalData_info = $this->zonalData->find($id);
        if (!$zonalData_info) {
            abort(404);
        }
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'publishStatus' => 'required|in:0,1'
        ]);
        $data = [
            'title' => $request->title,
            'publishStatus' => $request->publishStatus,
            'updated_by' => Auth::user()->id,
        ];
        try {
            DB::beginTransaction();
            $zonalData_info->fill($data)->save();
            $request->session()->flash('success', 'Shipment Zone updated successfully.');
            DB::commit();
            return redirect()->route('zonalData.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $zonalData_info = $this->zonalData->find($id);
        if (!$zonalData_info) {
            abort(404);
        }
        try {
            $zonalData_info->updated_by = Auth::user()->id;
            $zonalData_info->save();
            $zonalData_info->delete();
            $request->session()->flash('success', 'Shipment Zone deleted successfully.');
            return redirect()->route('zonalData.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    public function zonalEdit(Request $request, $serviceid, $zoneid)
    {

        $data = ZoneCountryServiceAgent::firstWhere(['zone_id' => $zoneid, 'serviceagent_id' => $serviceid]);

        if (empty($data)) {
            $request->session()->flash('error', 'Cannot edit this, please try again later');
            return redirect()->back();
        }
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $zones = ShipmentZone::where('id', '!=', '1')->where('publishStatus', true)->pluck('title', 'id');

        $zonalData_info = [
            'type' => $request->zone_id == 1 ? 'country' : 'zone',
            'serviceagent_id' => (int) $request->serviceid,
            'zone_id' => (int) $request->zoneid,
            'country_id' => array_map('intval', preg_split('/\-/', $request->country_id)),
            'requestCountryId' => $request->country_id,
        ];
        $title = 'Update Shipment Zone';
        return view('admin/zonalData/bulkedit', compact('zonalData_info', 'title', 'serviceAgents', 'zones'));
    }

    public function zonalUpdate(Request $request)
    {

        $data = Validator::make($request->all(), [
            'zone_id' => 'required|exists:shipment_zones,id',
            'serviceagent_id' => 'required|exists:service_agents,id',
            'country_id' => 'required|array|min:1',
            'country_id.*' => 'required|exists:countries,id'
        ])->validate();

        try {
            $allCountry = $this->zonalData->where('zone_id', $data['zone_id'])->where('serviceagent_id', $data['serviceagent_id'])->delete();
            foreach ($data['country_id'] as $country) {
                $this->zonalData->create([
                    'zone_id' => $data['zone_id'],
                    'serviceagent_id' => $data['serviceagent_id'],
                    'country_id' => $country,
                ]);
            }
            $request->session()->flash('success', 'Shipment Zone updated successfully.');
            return redirect()->route('zonal.index');
        } catch (\Throwable $th) {
            $request->session()->flash('error', 'Shipment Zone deleted successfully.');
            return redirect()->route('zonal.index');
        }
    }
    public function getCountries(Request $request)
    {

        $country = [];
        if ($request->countryId) {
            $country = array_map('intval', preg_split('/-/', $request->countryId));
        }

        try {
            $countries = Country::select('name', 'id')->orderBy('name', 'ASC')->get()
                ->map(function ($qr) use ($country) {
                    return ['id' => $qr->id, 'name' => $qr->name, 'selected' => in_array($qr->id, $country) ? 'selected' : null];
                });

            return response()->json($countries);
        } catch (\Exception $error) {
            return response()->json('error', $error->getMessage());
        }
    }
}
