<?php

namespace App\Http\Livewire;

use App\Models\Agent\ShipmentPackage;
use Livewire\Component;

class Seconddashboard extends Component
{
    public $shipment;
    public function mount()
    {
        $this->shipment = ShipmentPackage::whereDate('created_at', date('Y-m-d'))->where('agentId',Auth()->id())->get()->toArray();
    }
    public function render()
    {
        return view('livewire.seconddashboard');
    }
}
