<?php

namespace App\Http\Livewire;

use App\Models\Country as countries;
use Livewire\Component;


class Country extends Component
{
    public $country;
    public $readyToLoad = false;
    public function loadCountry()
    {
        $this->readyToLoad = true;
    }
    public function mount($country)
    {
        $this->country = countries::select('id', 'name')
            ->whereIn('id', explode(',', $country))
            ->get() ;
    }
    public function render()
    {
        return view('livewire.country');
    }
}
