<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use App\Models\ServiceAgent;
use App\Models\ShipmentZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZonePriceController extends Controller
{
    public function __construct(Pricing $pricing)
    {
        $this->pricing = $pricing;
    }
    public function getAgentPricing($request)
    {
        $query = Pricing::groupBy(['agent_id', 'serviceAgentId'])
            ->where('publishStatus', '1');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        return $query;
    }
    public function agentindex(Request $request)
    {
        $data = $this->getAgentPricing($request)->where('agent_id', auth()->user()->agentId ?? auth()->id())->paginate(20);
        $data = [
            'data' => $data,
            'title' => 'Agent Pricing',
        ];
        return view('admin/pricing/agentList', $data);
    }


    public function zone(Request $request)
    {
        $serviceAgents = DB::table('zone_country_service_agents')
            ->join('countries', 'countries.id', 'zone_country_service_agents.country_id')
            ->join('service_agents', 'service_agents.id', 'zone_country_service_agents.serviceagent_id')
            ->join('shipment_zones', 'shipment_zones.id', 'zone_country_service_agents.zone_id')
            ->when($request->agentService, fn ($query) => $query->where('service_agents.id', $request->agentService))
            ->select('countries.name', 'zone_country_service_agents.zone_id', 'shipment_zones.title', 'service_agents.title as servicetitle')
            ->get()
            ->groupBy('title');
        $serviceAgent = ServiceAgent::orderBy('title', 'Asc')->where('publishStatus','1')->get()->pluck('title', 'id');
        return view('admin/zonaldata/index', compact('serviceAgents', 'serviceAgent'));
    }
}
