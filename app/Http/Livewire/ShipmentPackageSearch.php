<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\carbon;
use App\Models\Agent\ShipmentPackage;

class ShipmentPackageSearch extends Component
{
    public $startDate;
    public $endDate;
    public $checkall = false;
    public $selectedId = [0];
    public $selectedPackages = [];

    public function mount($selectedId)
    {
        $this->selectedId = $selectedId ?? [0];

        $this->selectedPackages = $this->selectedItems();
    }

    public function searchShipmentPackages()
    {
        if (empty($this->startDate) || empty($this->endDate)) {
            return [];
        }
        return ShipmentPackage::select('id', 'package_status', 'barcode')
            ->where('manifest', false)
            ->whereDate('shipment_date', '>=', $this->startDate)
            ->whereDate('shipment_date', '<=', $this->endDate)
            ->where('manifest', 0)
            ->get()
            ->mapWithKeys(function ($package) {
                return [(int)$package->id => $package->barcode . "(" . $package->package_status . ")"];
            })
            ->toArray();
    }


    public function updatedCheckall($value)
    {
        if ($value) {
            $this->selectedId  = count($this->searchShipmentPackages()) ?
                $this->searchShipmentPackages() : [0];
        } else {
            $this->selectedId = [0];
        }
    }
    public function selectedItems()
    {
        return ShipmentPackage::whereIn('id', $this->selectedId)->get()->mapWithKeys(function ($package) {
            return [(int)$package->id => $package->barcode . "(" . $package->package_status . ")"];
        })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.shipment-package-search')
            ->with('shipmentPackages', $this->searchShipmentPackages());
    }
}
