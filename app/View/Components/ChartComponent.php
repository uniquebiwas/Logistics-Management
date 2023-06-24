<?php

namespace App\View\Components;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use PDO;

class ChartComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct()
    {
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chart-component')
            ->with('labels', json_encode($this->getServiceAgentData()->pluck('title')))
            ->with('datas', json_encode($this->getServiceAgentData()->pluck('total')))
            ->with('countryLabels', json_encode($this->getCountryData()->pluck('receiverCountry')))
            ->with('countryDatas', json_encode($this->getCountryData()->pluck('total')))
            ->with('agentLabels', json_encode($this->getAgentData()->pluck('company_name')))
            ->with('agentDatas', json_encode($this->getAgentData()->pluck('total')))
            ->with('statusLabels', json_encode($this->getStatusData()->pluck('package_status')))
            ->with('statusDatas', json_encode($this->getStatusData()->pluck('total')));
    }

    public function getServiceAgentData()
    {
        return DB::table('shipment_packages')
            ->when(!auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'AWB admin']), fn ($query) => $query->where('shipment_packages.agentId', auth()->id()))
            ->join('service_agents', 'service_agents.id', 'shipment_packages.service_agent')
            ->selectRaw("count(*) as total,service_agents.title")
            ->groupBy('service_agent')
            ->get();
    }

    public function getCountryData()
    {
        return DB::table('shipment_packages')
            ->when(!auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'AWB admin']), fn ($query) => $query->where('shipment_packages.agentId', auth()->id()))
            ->selectRaw("count(*) as total,receiverCountry")
            ->groupBy('receiverCountry')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
    }

    public function getAgentData()
    {
        return DB::table('shipment_packages')
            ->when(!auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'AWB admin']), fn ($query) => $query->where('shipment_packages.agentId', auth()->id()))
            ->join('agent_profiles', 'agent_profiles.userId', 'shipment_packages.agentId')
            ->selectRaw("count(*) as total,agent_profiles.company_name")
            ->groupBy('agentId')
            ->get();
    }

    public function getStatusData()
    {
        return DB::table('shipment_packages')
            ->when(!auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'AWB admin']), fn ($query) => $query->where('shipment_packages.agentId', auth()->id()))
            ->selectRaw("count(*) as total,package_status")
            ->groupBy('package_status')
            ->orderBy('total', 'desc')
            ->get();
    }
}
