<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Customer;
use Livewire\Component;

class AddCustomer extends Component
{
    public $ariaHidden = true;
    public $customerName;
    public $customerEmail;
    public $customerMobile;
    public $customerAddress;
    public $customerCountry;
    public $customerState;
    public $customerZipcode;
    public $customerCity;

    protected $rules = [
        'customerName' => 'required|min:6',
        'customerEmail' => 'required|email',
        'customerMobile' => 'required|numeric|numeric',
        'customerAddress' => 'required',
        'customerCountry' => 'required',
    ];
    public function customerSave()
    {
        $this->validate();
        try {
            Customer::create([
                'name' => $this->customerName,
                'address' => $this->customerAddress,
                'mobile' => $this->customerMobile,
                'state' => $this->customerState,
                'zipcode' => $this->customerZipcode,
                'country' => $this->customerCountry,
                'email' => $this->customerEmail,
                'city' => $this->customerCity
            ]);
            $this->setNullValue();
            $this->dispatchBrowserEvent('customerCreated');
            $this->emit('customerCreated');
        } catch (\Throwable $th) {
            request()->session()->flash('customerCreated', 'Error while creatating customer');
        }
    }
    public function setNullValue()
    {
        [
            $this->customerName,
            $this->customerAddress,
            $this->customerCity,
            $this->customerEmail,
            $this->customerMobile,
            $this->customerState,
            $this->customerZipcode
        ]
            = null;
        return true;
    }
    public function render()
    {
        return view('livewire.add-customer')
            ->with('countries', Country::orderBy('name', 'Asc')->get()->mapWithKeys(function ($country) {
                return [$country->id => $country->name];
            }));
    }
}
