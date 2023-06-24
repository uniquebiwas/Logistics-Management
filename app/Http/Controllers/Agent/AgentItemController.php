<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentFile;
use App\Models\Agent\ShipmentPackage;
use App\Models\Agent\WalletBalance;
use App\Models\AgentMembershipHistory;
use App\Models\Country;
use App\Models\Pricing;
use App\Models\ServiceAgent;
use App\Models\ShipmentCancellationReason;
use App\Models\ShipmentItems;
use App\Models\ShipmentPackageType;
use App\Models\User;
use App\Traits\Shared\AdminSharedTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentItemController extends Controller
{
    //
    use AdminSharedTrait;
    public function __construct(User $user, ShipmentPackage $shipment)
    {
        $this->user = $user;
        $this->shipment = $shipment;
    }
    public function allRequests(Request $request)
    {
        $shipments = $this->shipment->where('agentId', auth()->id())->orderBy('id', 'DESC')->paginate(20);
        $data = [
            'shipments' => $shipments,
            'title' => "My Shipment Requests"
        ];
        return view('agent.items.item-list', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->shipmentValidate($request));
        try {
            $agentId = auth()->id();
            DB::beginTransaction();
            $data = $this->mapSliderData($request);
            $data['agentId'] = $agentId;
            do {
                $number  = rand(100000, 900000);
                $repeated_code =  $this->shipment->where('barcode', $number)->first();
                $data['barcode_number'] = $number;
                $data['barcode'] = $number;
            } while ($repeated_code);
            $shipment =  $this->shipment->create($data);
            if ($request->images) {
                $imageItems = [];
                foreach ($request->images as $image) {
                    $imageItems[] = uploadFile($image, "agents/$agentId/shipments", false, time() . "-" . rand(78888, 99999), false);
                }
                if ($imageItems) {
                    foreach ($imageItems as $key => $value) {
                        ShipmentFile::create([
                            'shipmentId' => $shipment->id,
                            'agentId' => $shipment->agentId,
                            'filepath' => $value,
                        ]);
                    }
                }
            }
            $totalWeight = 0;
            foreach ($request->quantity as $key => $value) {
                ShipmentItems::create([
                    'quantity' => $request->quantity[$key] ?? 1,
                    'length' => $request->length[$key],
                    'weight' => $request->weight[$key],
                    'height' => $request->height[$key],
                    'shipmentPackageId' => $shipment->id,
                ]);
                $totalWeight += $request->weight[$key];
            }
            $shipment->total_weight = $totalWeight;
            $shipment->save();
            $membership = AgentMembershipHistory::orderBy('id', 'ASC')
                ->where('agentId', $shipment->agentId)->first();
            if (!$membership) {
                $request->session()->flash('error', 'No membership subscription');
                return redirect()->back();
            }
            $membership->usedRequest++;
            $membership->remainingRequestCount--;
            $membership->save();
            $wallet = WalletBalance::where('agentId', $shipment->agentId)->first();
            $wallet->balance = $wallet->balance - $this->getPrice($request->service_agent, $request->receiver_country, $request->shipment_package_type_id, $request->weight, auth()->id());
            $wallet->save();
            DB::commit();
            $request->session()->flash('success', "Your shipment package added successfully.");
            return redirect()->route('shipment.index');
        } catch (Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    protected function shipmentValidate($request)
    {
        $data = [
            'package_name' => 'required|string|max:200',
            'shipment_package_type_id' => 'required',
            'service_agent' => 'required',
            'shipment_type' => 'required',
            'sender_name' => 'required',
            'sender_mobile' => 'required',
            'sender_email' => 'required',
            'sender_address' => 'required',
            'sender_city' => 'required',
            'sender_state' => 'required',
            'sender_country' => 'required',
            'sender_zipcode' => 'required',
            'receiver_name' => 'required',
            'receiver_mobile' => 'required',
            'receiver_email' => 'required',
            'receiver_address' => 'required',
            'receiver_city' => 'required',
            'receiver_state' => 'required',
            'receiver_country' => 'required',
            'receiver_zipcode' => 'required',
            'payment_type' => 'required',
            'payment_method' => 'required',
            'quantity' => 'required',
            'weight' => 'required',
            'length' => 'required',
            'height' => 'required',
        ];
        if ($request->isMethod('post')) {
            $data['images'] = 'required';
        }
        return $data;
    }

    protected function mapSliderData($request)
    {
        $data = [
            'package_name' => $request->package_name,
            'shipment_package_type_id' => $request->shipment_package_type_id,
            'service_agent' => $request->service_agent,
            'shipment_type' => $request->shipment_type,
            'sender_name' => $request->sender_name,
            'sender_mobile' => $request->sender_mobile,
            'sender_email' => $request->sender_email,
            'sender_address' => $request->sender_address,
            'sender_city' => $request->sender_city,
            'sender_state' => $request->sender_state,
            'sender_country' => $request->sender_country,
            'sender_zipcode' => $request->sender_zipcode,
            'receiver_name' => $request->receiver_name,
            'receiver_mobile' => $request->receiver_mobile,
            'receiver_email' => $request->receiver_email,
            'receiver_address' => $request->receiver_address,
            'receiver_city' => $request->receiver_city,
            'receiver_state' => $request->receiver_state,
            'receiver_country' => $request->receiver_country,
            'receiver_zipcode' => $request->receiver_zipcode,
            'payment_type' => $request->payment_type,
            'payment_method' => $request->payment_method,
            'remarks' => $request->remarks,
        ];
        return $data;
    }

    public function show($id)
    {
        $shipmentPackage_info = $this->shipment->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        $cancellation_reasons = ShipmentCancellationReason::where('publishStatus', 1)->where('usage_by', 0)->pluck('title', 'id');
        $title = $shipmentPackage_info->package_name . ' Detail';
        $total = $shipmentPackage_info->shipping_charge + $shipmentPackage_info->gov_tax + $shipmentPackage_info->service_agent_charge + $shipmentPackage_info->service_charge;
        // dd($cancellation_reasons);
        return view('admin/shipmentpackage/detail', compact('shipmentPackage_info', 'title', 'total', 'cancellation_reasons'));
    }

    public function edit(Request $request, $id)
    {
        $shipment = $this->shipment->where('id', $id)->where('agentId', auth()->id())->first();
        if (!$shipment) {
            $request->session()->flash('error', 'Invalid shipment information.');
            return redirect()->route('shipment.index');
        }

        $countries = Country::pluck('name', 'id');
        $serviceAgents = ServiceAgent::where('publishStatus', 1)->pluck('title', 'id');
        $data =  [
            "title" => "Update Shipment",
            "shipmentInfo" => $shipment,
            "countries" => $countries,
            "packageTypes" => ShipmentPackageType::where('publishStatus', '1')->get()->pluck('package_type', 'id'),
            "serviceAgents" => $serviceAgents,
            "url" => route('shipment.update', $shipment->id)
        ];
        return view('agent.items.create-shipment', $data);
    }


    public function cancel(Request $request, $id)
    {
        $shipment = $this->shipment->where('id', $id)->where('agentId', auth()->id())->first();
        if (!$shipment) {
            $request->session()->flash('error', 'Invalid shipment information.');
            return redirect()->route('shipment.index');
        }
        try {
            DB::beginTransaction();
            $data = [
                'package_status' => 'CANCELLED',
                'cancelled_by_type' => 'AGENT',
                'cancellation_reason' => $request->cancellation_reason,
                'cancellation_remarks' => $request->cancellation_remarks,
                'cancelled_by' => Auth::user()->id,
            ];
            $shipment =  $shipment->fill($data)->save();
            $membership = AgentMembershipHistory::orderBy('id', 'ASC')
                ->where('agentId', auth()->id())->first();
            $membership->usedRequest--;
            $membership->remainingRequestCount++;
            $membership->cancelledRequest++;
            $membership->save();
            $wallet = WalletBalance::where('agentId', auth()->id())->first();
            $wallet->balance = $wallet->balance + $this->getPrice($shipment->service_agent, $shipment->receiver_country, $shipment->shipment_package_type_id, $shipment->weight, auth()->id());
            $wallet->save();
            DB::commit();
            $request->session()->flash('success', "Your shipment package has been cancelled.");
            return redirect()->route('shipment.index');
        } catch (Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $shipment = $this->shipment->where('id', $id)->where('agentId', auth()->id())->first();
        if (!$shipment) {
            $request->session()->flash('error', 'Invalid shipment information.');
            return redirect()->route('shipment.index');
        }
        $user = auth()->user();
        try {
            DB::beginTransaction();
            $data =  $request->all();

            $shipment =  $shipment->fill($data)->save();
            // dd($shipment);
            if ($request->images) {
                $imageItems = [];
                foreach ($request->images as $image) {
                    $imageItems[] =         uploadFile($image, "agents/$user->id/shipments", false, time() . "-" . rand(78888, 99999), false);
                }
                if ($imageItems) {
                    $shipment->shipmentFiles->sync($imageItems);
                }
            }
            DB::commit();
            $request->session()->flash('success', "Your shipment package  successfully updated.");
            return redirect()->route('shipment.index');
        } catch (Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $shipment = $this->shipment->where('id', $id)->where('agentId', auth()->id())->first();
        if (!$shipment) {
            $request->session()->flash('error', 'Invalid shipment information.');
            return redirect()->route('shipment.index');
        }

        try {
            DB::beginTransaction();
            $shipment->delete();

            DB::commit();
            $request->session()->flash('success', "Shipment removed successfully.");
        } catch (Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
        }
        return redirect()->route('shipment.index');
    }

    public function getCountries(Request $request)
    {
        try {
            $ids = Pricing::select('country_id')->where('serviceAgentId', $request->serviceAgentId)->pluck('country_id');

            $countries = Country::select('name', 'id')->orderBy('name', 'ASC')->whereIn('id', $ids)->get()->map(function ($data) {
                return ['id' => $data->id, 'name'=>$data->name];
            });
            $data = [
                'length' => $countries->count(),
                'country' =>  $countries,
            ];
            return response()->json(
                $data
            );
        } catch (\Exception $error) {
            return response()->json('error', $error->getMessage());
        }
    }
}
