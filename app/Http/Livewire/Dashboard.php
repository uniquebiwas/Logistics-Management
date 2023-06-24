<?php

namespace App\Http\Livewire;

use App\Models\Agent\ShipmentPackage;
use App\Models\Agent\WalletBalance;
use App\Models\AgentCreditBalance;
use App\Models\User;
use App\Models\UserType;
use Livewire\Component;

class Dashboard extends Component
{
    public $wallet, $package, $agents;
    public function mount()
    {
        $this->wallet = AgentCreditBalance::get()->sum('balance');
        $this->package = ShipmentPackage::count();
        $this->agents = UserType::where('typeId', 2)->count();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
