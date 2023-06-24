<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;

class Selectedcountry extends Component
{
    public $countries;
    public $selected;
    public function mount(Array $country_id)
    {
        $this->countries = Country::orderBy('name', 'Asc')->get()->mapWithKeys(function ($query) {
            return [$query->id => $query->name];
        });
        $this->selected = $country_id;
    }
    public function render()
    {
        return view('livewire.selectedcountry');
    }
}
