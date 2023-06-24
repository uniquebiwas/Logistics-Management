<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Country;

class Receiver extends Component
{
    public $type, $receiverId, $receiverCustomer,$attention,$countries,$receiver_info;
    protected $listeners = ['customerCreated' => 'refreshCustomer'];
    public function mount($type, $model, $receiverId = 0)
    {
        $this->type = $type;
        $this->receiverId = $receiverId;
        $this->attention = $model->receiverAttention;
        $this->receiver_info = $model;
        $this->countries = Country::select('name', 'id')->orderBy('name','asc')->get();
        $this->receiverCustomer = Customer::get()->mapWithKeys(function ($customer) {
            return [$customer->id => $customer->name];
        });
    }
    public function refreshCustomer()
    {
        $this->receiverCustomer =  Customer::get()->mapWithKeys(function ($customer) {
            return [$customer->id => $customer->name];
        });
    }
    public function render()
    {
        // $receiver = Customer::with('getCountry')->find($this->receiverId) ?? new Customer();
        
        return view('livewire.receiver')
            ->with('reciever',Customer::with('getCountry')->find($this->receiverId) ?? new Customer() );
    }
}
