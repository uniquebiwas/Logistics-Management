<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Country;
use Livewire\Component;
use Illuminate\Support\Str;

class Sender extends Component
{
    public $type, $allCustomer, $sender_info, $reference_number,$countries;
    protected $listeners = ['customerCreated' => 'refreshCustomer'];

    public function mount($type, $model)
    {
        $this->type = $type;
        $this->countries = Country::pluck('name', 'id');
        $this->sender_info = $model;
        $this->reference_number = $this->getReferenceNumber($model->reference_number);
        $this->allCustomer = Customer::get()->mapWithKeys(function ($customer) {
            return [$customer->id => $customer->name];
        });
    }

    public function getReferenceNumber($reference)
    {
       return $reference ?? Str::random(8);
    }
    public function refreshCustomer()
    {
        $this->allCustomer =  Customer::get()->mapWithKeys(function ($customer) {
            return [$customer->id => $customer->name];
        });
    }
    public function render()
    {
        return view('livewire.sender');
    }
}
