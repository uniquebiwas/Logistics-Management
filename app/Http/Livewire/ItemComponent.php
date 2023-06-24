<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItemComponent extends Component
{
    public $row = 5;

    public function render()
    {
        return view('livewire.item-component');
    }
}
