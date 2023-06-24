<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\ShipmentLocation;
use App\Models\Country;
use App\Models\Location;
use App\Models\ShipmentCharge;
use App\Models\StatusLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Utilities\LogActivity;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ShipmentLocationController extends Controller
{
    public $location;
    public function __construct(Location $location)
    {
        $this->location = $location->get();
    }

    public function index($shipmentId)
    {
        $package = ShipmentPackage::with('getServiceAgent')->findOrFail($shipmentId);
        $shipmentPackage = ShipmentLocation::with('country')->where('shipmentId', $shipmentId)
            ->latest('date')
            ->get()
            ->groupBy(function ($data) {
                return $data->date->format('Y-m-d');
            });
        $location = $this->getStaticKeywords('LOCATION');
        $receivedStatus = $this->getStaticKeywords('RECEIVED');
        $dispatchedStatus = $this->getStaticKeywords('DISPATCHED');
        $manifestedStatus = $this->getStaticKeywords('MANIFESTED');


        $countries = Country::select('id', 'name')->orderBy('name', 'Asc')->get()->mapWithKeys(function ($country) {
            return [$country->id => $country->name];
        });

        return view('admin.shipmentpackage.location', compact('shipmentPackage', 'package', 'countries', 'location', 'receivedStatus', 'manifestedStatus', 'dispatchedStatus'));
    }

    public function store(Request $request, $shipmentId)
    {
        $package = ShipmentPackage::findOrFail($shipmentId);
        $data =  Validator::make($request->all(), [
            'countryId' => 'required|exists:countries,id',
            'date' => 'required|date',
            'location' => 'nullable',
            'remarks' => 'nullable',
            'package_status' => 'required',
            'extra_status' => 'nullable',
            'tracking_code' => 'required_if:package_status,HANDOVERTOAGENT'
        ])->validated();

        $data['date'] = Carbon::parse($data['date'])->toDateTimeString();
        $data['extra_status'] = in_array($data['package_status'], ['RECEIVED', 'DISPATCHED', 'MANIFESTED']) ? $data['extra_status'] ?? null : null;

        if ($request->package_status == 'MANIFESTED') {
            if ($package->manifest == false || $package->nationalManifest == false) {
                $request->session()->flash('error', 'Manifest for this AWB must be created first');
                return redirect()->back();
            }
        }
        if ($request->package_status == 'SCHEDULED') {
            if ($package->export) {
                $request->session()->flash('error', 'Uploading for this AWB must be created first');
                return redirect()->back();
            }
        }
        $data['shipmentId'] = $shipmentId;
        DB::beginTransaction();
        try {
            $package->update(['package_status' => $data['package_status']]);
            ShipmentLocation::create(Arr::except($data, ['tracking_code']));
            if ($data['package_status'] == 'HANDOVERTOAGENT') {
                $package->update([
                    'invoice' => '1',
                    'manifest' => '1',
                    'export' => '1',
                    'nationalManifest' => '1',
                ]);
            }
            if ($request->tracking_code) {
                $package->update(
                    ['tracking_code' => $request->tracking_code]
                );
            }
            if ($request->package_status == 'SCHEDULED') {
                $package->update([
                    'airlines' => $request->airlines,
                    'flightNumber' => $request->flightNumber,
                    'scheduled_for' => $request->scheduled_for,
                    'scheduled_by' => auth()->user()->id,
                    'scheduled_at' => Carbon::now(),
                ]);
            }

            if ($data['package_status'] == 'RECEIVED'  && $data['extra_status'] !== 'Received at ALG warehouse') {
                ShipmentCharge::where('shipmentId', $package->id)->update([
                    'tiaCharge' => 0,
                    'tiaCalculatedCharge' => 0
                ]);
            }


            DB::commit();
            LogActivity::addToLog('awb ' . strtolower($request->package_status));

            $request->session()->flash('success', 'Status with location updated successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();

            $request->session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function getStaticKeywords($type)
    {
        return $this->location->where('type', $type)->mapWithKeys(function ($location) {
            return [$location->title => $location->title];
        });
    }
}
