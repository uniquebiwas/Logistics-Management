<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Pricing;
use App\Models\ServiceAgent;
use App\Models\ShipmentPackageType;
use App\Models\ShipmentZone;
use App\Models\User;
use App\Models\UserType;
use App\Models\WeightPrice;
use App\Models\ZoneCountryServiceAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PricingController extends Controller
{
    public function __construct(Pricing $pricing, User $user)
    {
        $this->pricing = $pricing;
        $this->user = $user;
    }

    protected function getpricing($request)
    {
        $query = Pricing::with(['getZone', 'getCountry'])->where('publishStatus', '1');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        return $query;
    }

    public function getAgentPricing($request)
    {
        $query = Pricing::groupBy(['agent_id', 'serviceAgentId'])
            ->orderBy('id', 'desc')
            ->where('publishStatus', '1');
        if ($request->agentId) {
            $query = $query->where('agent_id', $request->agentId);
        }
        return $query;
    }
    public function index(Request $request)
    {
        $data = $this->getpricing($request)->whereNull('agent_id')->paginate(20);
        $data = [
            'data' => $data,
            'title' => 'Pricing',
        ];
        return view('admin/pricing/list', $data);
    }
    public function agentindex(Request $request)
    {
        $data = $this->getAgentPricing($request)->whereNotNull('agent_id')->paginate(20);
        $agents = User::select('id', 'name')
            ->with('roles')
            ->with('agent_profile')
            ->get()
            ->filter(function ($user, $key) {
                return $user->hasRole('Agent');
            })
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->agent_profile->company_name];
            });

        $data = [
            'data' => $data,
            'title' => 'Agent Pricing',
            'agentList' => $agents,
        ];
        return view('admin/pricing/agentList', $data);
    }

    public function create(Request $request)
    {
        $pricing_info = null;
        $package_types = ShipmentPackageType::orderBy('package_type', 'ASC')->pluck('package_type', 'id');
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $title = 'Add New Pricing';
        $data = [
            'title' => $title,
            'pricing_info' => $pricing_info,
            'serviceAgents' => $serviceAgents,
            'package_types' => $package_types,
        ];
        return view('admin/pricing/form', $data);
    }
    public function agentPricingCreate(Request $request)
    {
        $pricing_info = null;
        $agents = User::select('id', 'name')
            ->with('roles')
            ->with('agent_profile')
            ->get()
            ->filter(function ($user, $key) {
                return $user->hasRole('Agent');
            })
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->agent_profile->company_name . " (" . $user->name['en'] . ")"];
            });

        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id');
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $title = 'Add New Agent Pricing';
        $data = [
            'title' => $title,
            'pricing_info' => $pricing_info,
            'countries' => $countries,
            'serviceAgents' => $serviceAgents,
            'users' => $agents,
        ];
        return view('admin/pricing/form', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'serviceAgentId' => 'required|numeric|exists:service_agents,id',
            'zoneOrCountry' => 'required|in:Zone,Country',
            'region' => 'required',
            'weight' => 'required|array',
            'price' => 'required',
            'publishStatus' => 'required|in:0,1'
        ];
        if (strpos(url()->previous(), 'agent-pricing') !== false) {
            $data['agent_id'] = 'required|array';
        }
        $this->validate($request, $data);
        try {
            DB::beginTransaction();
            $creator = Auth::user()->id;
            foreach ($request->agent_id as  $agent) {
                foreach ($request->region as $key => $value) {
                    $data = [
                        'agent_id' => $agent,
                        'serviceAgentId' => $request->serviceAgentId,
                        'createdBy' => $creator,

                    ];
                    if ($request->zoneOrCountry == 'Zone') {
                        $data['zone_id'] = $value;
                    } elseif ($request->zoneOrCountry == 'Country') {
                        $data['country_id'] = $value;
                    }
                    $pricing = Pricing::create($data);
                    for ($i = 0; $i < count($request->weight); $i++) {
                        if (isset($request->weight[$i])  && isset($request->price[$i])) {
                            WeightPrice::create([
                                'weight' => $request->weight[$i],
                                'price' => $request->price[$i],
                                'pricing_id' => $pricing->id,
                            ]);
                        }
                    }
                }
            }
            $request->session()->flash('success', 'Pricing data added successfully.');
            DB::commit();
            if (strpos(url()->previous(), 'agent-pricing') !== false) {
                return redirect()->route('admin.pricing.agent');
            } else {
                return redirect()->route('pricing.index');
            }
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function agentPricingEdit(Request $request, $id)
    {
        $pricing_info = $this->pricing->find($id);
        if (!$pricing_info) {
            abort(404);
        }
        $users = User::select('id', 'name')
            ->with('roles')
            ->with('agent_profile')
            ->get()
            ->filter(function ($user, $key) {
                return $user->hasRole('Agent');
            })
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->agent_profile->company_name . " (" . $user->name['en'] . ")"];
            });
        $package_types = ShipmentPackageType::orderBy('package_type', 'ASC')->pluck('package_type', 'id');
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $title = 'Update Pricing';
        $region = $pricing_info->zone_id ? $pricing_info->getZone->title : $pricing_info->getCountry->name;
        $data = [
            'title' => $title,
            'pricing_info' => $pricing_info,
            'serviceAgents' => $serviceAgents,
            'region' => $region,
            'users' => $users,
            'package_types' => $package_types,
        ];
        return view('admin/pricing/form', $data);
    }
    public function edit(Request $request, $id)
    {
        $pricing_info = $this->pricing->find($id);
        if (!$pricing_info) {
            abort(404);
        }
        $package_types = ShipmentPackageType::orderBy('package_type', 'ASC')->pluck('package_type', 'id');
        $serviceAgents = ServiceAgent::where('publishStatus', true)->pluck('title', 'id');
        $title = 'Update Pricing';
        $region = $pricing_info->zone_id ? $pricing_info->getZone->title : $pricing_info->getCountry->name;
        $data = [
            'title' => $title,
            'pricing_info' => $pricing_info,
            'serviceAgents' => $serviceAgents,
            'region' => $region,
            'package_types' => $package_types,
        ];
        return view('admin/pricing/form', $data);
    }

    public function update(Request $request, $id)
    {
        $pricing_info = $this->pricing->find($id);
        if (!$pricing_info) {
            abort(404);
        }
        $this->validate($request, [
            'weight_from' => 'nullable',
            'weight_to' => 'nullable',
            'price' => 'required',
            'publishStatus' => 'required|in:0,1'
        ]);
        $data = [
            'publishStatus' => $request->publishStatus,
            'updated_by' => Auth::user()->id,
        ];
        try {
            DB::beginTransaction();
            $pricing_info->fill($data)->save();
            WeightPrice::where('pricing_id', $pricing_info->id)->delete();
            for ($i = 0; $i < count($request->weight_from); $i++) {
                if (isset($request->weight_from[$i]) && isset($request->weight_to[$i]) && isset($request->price[$i])) {
                    WeightPrice::create([
                        'weight_from' => $request->weight_from[$i],
                        'weight_to' => $request->weight_to[$i],
                        'price' => $request->price[$i],
                        'pricing_id' => $pricing_info->id,
                    ]);
                }
            }
            $request->session()->flash('success', 'Pricing data updated successfully.');
            DB::commit();
            if (strpos(url()->previous(), 'agent-pricing') !== false) {
                return redirect()->route('admin.pricing.agent');
            } else {
                return redirect()->route('pricing.index');
            }
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $pricing_info = $this->pricing->find($id);
        if (!$pricing_info) {
            abort(404);
        }
        try {
            $this->pricing->where(['serviceAgentId' => $pricing_info->serviceAgentId, 'agent_id' => $pricing_info->agent_id])->delete();
            WeightPrice::where('pricing_id', $pricing_info->id)->delete();
            $request->session()->flash('success', 'Pricing  deleted successfully.');
            if (request()->routeIs('admin.pricing.agent')) {
                return redirect()->route('admin.pricing.agent');
            }
            return redirect()->route('pricing.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function getCountriesAndZone(Request $request)
    {

        try {
            if ($request->zoneOrCountry == 'Zone') {

                $ids = ZoneCountryServiceAgent::where('serviceagent_id', $request->serviceAgentId)
                    ->distinct('zone_id')
                    ->where('zone_id', '!=', '1')
                    ->pluck('zone_id');


                $region =  ShipmentZone::select('id', 'title')->whereIn('id', $ids)->get()->map(function ($data) {
                    return ['id' => $data->id, 'title' => $data['title']];
                });
            } elseif ($request->zoneOrCountry == 'Country') {
                $ids = ZoneCountryServiceAgent::where('serviceagent_id', $request->serviceAgentId)
                    ->where('zone_id', '1')
                    ->pluck('country_id');
                // dd($ids);
                $region = Country::select('id', 'name')->whereIn('id', $ids)
                    ->get()
                    ->map(function ($data) {
                        return ['id' => $data->id, 'title' => $data['name']];
                    });
            }


            return  response()->json($region);
        } catch (\Exception $error) {
            return response()->json('error', $error->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $pricing_info = $this->pricing->findorfail($id);
        $zoneCount = ShipmentZone::where('serviceAgentId', $pricing_info->serviceAgentId)->count();

        // $pricing = $this->pricing->where(['serviceAgentId' => $pricing_info->serviceAgentId, 'agent_id' => $pricing_info->agent_id])->orderBy('id', 'desc')->limit($zoneCount)->get()->pluck('id')->toArray();
        $maxEffectiveDate = $this->pricing->where(['serviceAgentId' => $pricing_info->serviceAgentId, 'agent_id' => $pricing_info->agent_id])->max('effectiveDate');

        $pricing = $this->pricing
            ->where(['serviceAgentId' => $pricing_info->serviceAgentId, 'agent_id' => $pricing_info->agent_id])
            ->where('effectiveDate', $maxEffectiveDate)
            ->orderBy('id', 'desc')
            ->limit($zoneCount)
            ->get()
            ->groupBy(function ($pricing) {
                return $pricing->effectiveDate->format('Y-m-d h:i:s');
            });
        $zone = ShipmentZone::select('title')->where('serviceAgentId', $pricing_info->serviceAgentId)->get();
        $tables = [];
        foreach ($pricing as $key => $items) {
            $id = $items->pluck('id');
            $tables[] = DB::table('weight_prices')
                ->whereIn('pricing_id', $id)
                ->orderBy('pricing_id', 'desc')
                ->orderBy('weight', 'asc')
                ->join('pricings', 'pricings.id', 'weight_prices.pricing_id')
                ->join('shipment_zones', 'pricings.zone_id', 'shipment_zones.id')
                ->select('weight_prices.price', 'weight_prices.weight', 'shipment_zones.title')
                ->where('pricings.serviceAgentId',  $pricing_info->serviceAgentId)
                ->get()
                ->groupBy('title')
                ->reverse();
        }
        $dates = $pricing->keys();


        $serviceAgents = ServiceAgent::find($pricing_info->serviceAgentId);

        return view('admin.pricing.detail', compact('tables', 'zone', 'pricing', 'serviceAgents', 'pricing_info', 'dates'));
    }
}
