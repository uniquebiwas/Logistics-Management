<?php

namespace App\Http\Controllers\Admin;

use App\Events\ShipmentItemsCreated;
use App\Events\ShipmentPackageCreated;
use App\Events\UpdateCredit;
use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentFile;
use App\Models\Agent\ShipmentPackage;
use App\Models\AgentMembershipHistory;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Pricing;
use App\Models\ServiceAgent;
use App\Models\ShipmentCancellationReason;
use App\Models\ShipmentCharge;
use App\Models\ShipmentItems;
use App\Models\ShipmentPackageType;
use Barryvdh\DomPDF\Facade  as PDF;
use App\Traits\Shared\AdminSharedTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use ZipArchive;
use App\Utilities\LogActivity;
use App\Models\AgentCreditBalance;
use App\Models\AppSetting;
use App\Models\Credit;
use App\Models\ShipmentLocation;
use App\Models\User;
use App\Models\ZoneCountryServiceAgent;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Mail as FacadesMail;

class ShipmentPackageController extends Controller
{
    use AdminSharedTrait;
    public function __construct(ShipmentPackage $shipmentPackage)
    {
        $this->shipmentPackage = $shipmentPackage;
    }

    protected function getShipmentPackage($request, $status = null, $cancelledBy = null, $received = null)
    {
        $limit = 20;
        if ($request->limit) {
            $limit = $request->limit;
        }
        $query = $this->shipmentPackage;
        if ($received) {
            $query = $query->withCount('loads');
        }
        if ($request->keyword) {
            $query = $query->where('barcode', $request->keyword);
        }
        if ($request->agentId) {
            $query = $query->where('agentId', $request->agentId);
        }

        if ($status) {
            $query = $query->where('package_status', $status);
        }
        if ($cancelledBy) {
            $query = $query->where('package_status', $status)->where('cancelled_by_type', $cancelledBy);
        }

        if ($request->startDate) {
            $query = $query->whereDate('shipment_date', '>=', $request->startDate);
        }

        if ($request->endDate) {
            $query = $query->whereDate('shipment_date', '<=', $request->endDate);
        }
        if ($request->service_agent) {
            $query = $query->where('service_agent', $request->service_agent);
        }


        if (auth()->user()->roles->first()->name == 'Agent') {
            $query = $query->where('agentId', auth()->id());
        }
        return $query->with('getSender')->withCount('shipmentFiles')->orderBy('id', 'DESC')->paginate($limit)->appends(request()->all());
    }



    public function getCountries(Request $request)
    {
        try {
            $ids = Pricing::where('serviceAgentId', $request->serviceAgentId)->pluck('country_id');

            $countries = Country::select('name', 'id')->orderBy('name', 'ASC')->whereIn('id', $ids)->get()->map(function ($data) {
                return ['id' => $data->id, 'name' => $data->name];
            });
            $data = [
                'length' => $countries->count(),
                'country' =>  $countries,
            ];
            return response()->json($data);
        } catch (\Exception $error) {
            return response()->json('error', $error->getMessage());
        }
    }

    public function index(Request $request)
    {
        $title = 'All Shipment Packages';
        $data = $this->getShipmentPackage($request);
        $serviceAgent = ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id');
        return view('admin/shipmentpackage/list', compact('data', 'title', 'serviceAgent'));
    }
    public function pendingIndex(Request $request)
    {
        $title = 'Pending Shipment Packages';
        $data = $this->getShipmentPackage($request, 'PENDING');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function approvedIndex(Request $request)
    {
        $title = 'Approved Shipment Packages';
        $data = $this->getShipmentPackage($request, 'APPROVED');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }

    public function handovertoagentIndex(Request $request)
    {
        $title = 'Approved Shipment Packages';
        $data = $this->getShipmentPackage($request, 'HANDOVERTOAGENT');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function receivedIndex(Request $request)
    {
        $title = 'Received Shipment Packages';
        $data = $this->getShipmentPackage($request, 'RECEIVED', false, true);
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function scheduledIndex(Request $request)
    {
        $title = 'Scheduled Shipment Packages';
        $data = $this->getShipmentPackage($request, 'SCHEDULED');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/scheduled', $data);
    }
    public function dispatchedIndex(Request $request)
    {
        $title = 'Dispatched Shipment Packages';
        $data = $this->getShipmentPackage($request, 'DISPATCHED');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function incargoIndex(Request $request)
    {
        $title = 'In Cargo Shipment Packages';
        $data = $this->getShipmentPackage($request, 'INCARGO');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function deliveredIndex(Request $request)
    {
        $title = 'Delivered Shipment Packages';
        $data = $this->getShipmentPackage($request, 'DELIVERED');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function adminCancelledIndex(Request $request)
    {
        $title = 'Cancelled Packages ';
        $data = $this->getShipmentPackage($request, 'CANCELLED');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function agentCancelledIndex(Request $request)
    {
        $title = 'Agent Cancelled Packages';
        $data = $this->getShipmentPackage($request, 'CANCELLED', 'AGENT');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function manifestedIndex(Request $request)
    {

        $title = 'Manifested Shipment Packages';
        $data = $this->getShipmentPackage($request, 'MANIFESTED');
        $data = [
            'title' => $title,
            'data' => $data,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }
    public function create(Request $request)
    {
        $serviceAgents = ServiceAgent::where('publishStatus', 1)->pluck('title', 'id');
        if (Auth()->user()->agent) {
            $remaining_request = Credit::where('agentId', auth()->user()->id)
                ->selectRaw('SUM(creditAmount) as remain')
                ->first();
        }
        $data =  [
            "title" => "Add New Shipment",
            "shipmentPackage_info" => new ShipmentPackage(),
            "packageTypes" => ShipmentPackageType::where('publishStatus', '1')->get()->pluck('package_type', 'id'),
            "serviceAgents" => $serviceAgents,
            "remaining_request" => $remaining_request->remain ?? null,
            "url" => request()->is('agent/shipment*') ? route('shipment.store') : route('shipmentpackage.store'),
            'shipmentCharge' => new ShipmentCharge(),
            'countries' => $this->getCountry(),
        ];
        return view('admin/shipmentpackage/form', $data);
    }

    protected function shipmentValidate($request, ShipmentPackage $shipmentPackage)
    {
        $data = [
            'shipment_type' => 'required',
            'piece_number' => 'required|array',
            'piece_number.*' => 'required|numeric',
            'weight' => 'required|array',
            'length' => 'required|array',
            'height' => 'required|array',
            'weight.*' => 'required|numeric',
            'length.*' => 'required|numeric',
            'height.*' => 'required|numeric',
            'senderAttention' => 'required',
            'senderAddress' => 'required',
            'senderMobile' => 'required',
            'senderEmail' => 'required',
            'receiverAttention' => 'required',
            'receiverAddress' => 'required',
            'service_agent' => 'required|exists:service_agents,id',
            'content' => 'required',
            'value' => 'required',
            'receiverCountry' => 'required',
            'receiverCountryId' => 'required|exists:countries,id'
        ];
        if ($request->isMethod('post')) {
            $data['service_agent'] = 'required';
            $data['images'] = 'nullable';
            $data['accept_terms'] = 'required';
        }
        return $data;
    }

    protected function mapShipmentData($request)
    {
        $data = [
            'shipment_type' => $request->shipment_type,
            'currency_type' => $request->currency_type,
            'remarks' => $request->remarks,
            'receiverAttention' => $request->receiverAttention,
            'account_number' => $request->account_number,
            'content' => $request->content,
            'value' => bcdiv($request->value, 1, 2),
            'totalPiece' => $request->totalPiece,
            'senderName' => $request->senderName,
            'senderState' => $request->senderState,
            'senderEmail' => $request->senderEmail,
            'senderMobile' => $request->senderMobile,
            'senderCountry' => 'Nepal',
            'senderZipCode' => $request->senderZipCode,
            'senderCity' => $request->senderCity,
            'senderAddress3' => $request->senderAddress3,
            'senderAddress2' => $request->senderAddress2,
            'senderAddress' => $request->senderAddress,
            'senderAttention' => $request->senderAttention,
            'receiverName' => $request->attention,
            'receiverState' => $request->receiverState,
            'receiverEmail' => $request->receiverEmail,
            'receiverMobile' => $request->receiverMobile,
            'receiverCountry' => $request->receiverCountry,
            'receiverZipCode' => $request->receiverZipCode,
            'receiverCity' => $request->receiverCity,
            'receiverAddress3' => $request->receiverAddress3,
            'receiverAddress2' => $request->receiverAddress2,
            'receiverAddress' => $request->receiverAddress,
            'receiverTelephone' => $request->receiverTelephone,
            'receiverCompany' => $request->receiverCompany,
            'receiverConsigneeCode' => $request->receiverConsigneeCode,
            'receiverCountryId' => $request->receiverCountryId,
            'export_type' => $request->export_type,
            'destination_duties' => $request->destination_duties,
            'service_agent' => $request->service_agent,
            'payment_terms' => $request->payment_terms,
            'billing_account' => $request->billing_account,
            'shipmentReference' => $request->shipmentReference
        ];
        if ($request->isMethod('post')) {
            $data['created_by'] = auth()->id();
            // $data['service_agent'] = $request->service_agent;
            $data['shipment_date'] = $request->shipment_date;
            $data['accept_terms'] = true;
        }
        return $data;
    }

    public function store(Request $request)
    {
        $agentId = $request->agentId ?? auth()->user()->agentId ?? auth()->id();
        $credit =   AgentCreditBalance::where('agentId', $agentId)->first();
        if (!$credit) {
            request()->session()->flash('error', 'You Don\'t have Credit. Please contact admin');
            return redirect()->back()->withInput();
        }
        if ($credit->dueDate->lt(now())) {
            request()->session()->flash('error', 'Your Credit has Expired');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $this->mapShipmentData($request);
            $data['agentId'] = $agentId;
            $data['billing_account'] =  $request->billing_account ?? optional(User::with('agent_profile')->find($agentId))->agent_profile->company_name;
            $shipment =  $this->shipmentPackage->create($data);
            event(new ShipmentPackageCreated($shipment));
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
            foreach ($request->piece_number as $key => $value) {
                $items = ShipmentItems::create([
                    'piece_number' => $request->piece_number[$key] ?? 1,
                    'length' => $request->length[$key],
                    'weight' => $request->weight[$key],
                    'height' => $request->height[$key],
                    'width' => $request->width[$key],
                    'volume_weight' => bcdiv(($request->length[$key] * $request->width[$key] * $request->height[$key] * $request->piece_number[$key]) / 5000, 1, 4),
                    'shipmentPackageId' => $shipment->id,
                ]);
                event(new ShipmentItemsCreated($items));
                $totalWeight += $request->weight[$key];
            }
            $shipment->total_weight = bcdiv($totalWeight, 1, 3);
            $shipment->total_volume_weight = bcdiv($request->total_volume_weight, 1, 3);
            $shipment->total_chargeable_weight = bcdiv($request->total_chargeable_weight, 1, 3);
            $shipment->save();
            $zoneId = ZoneCountryServiceAgent::where('country_id', $shipment->receiverCountryId)->where('serviceagent_id', $shipment->service_agent)->latest()->first();
            if (!$zoneId) {
                request()->session()->flash('error', 'The Selected country doesn\'t have price included');
                return redirect()->back()->withInput();
            }

            //Checking the price of the shipement
            $price = $this->getTotalWeight($shipment->service_agent, $zoneId->zone_id, $shipment->total_chargeable_weight, $agentId);
            if (!$price['price'] || $price['price'] == 0) {
                request()->session()->flash('error', 'The Selected country doesn\'t have price included for given integrator');
                return redirect()->back()->withInput();
            }
            if ($price['price'] > $credit->balance) {
                request()->session()->flash('error', 'Credit Amount is less than the required cost.Contact Admin');
                return redirect()->back()->withInput();
            }
            event(new UpdateCredit($price['price'], $agentId));
            $shipment->update(['total_chargeable_weight' => $price['chargeableWeight']]);
            $this->generateShipmentCharge($shipment, $price);
            ShipmentLocation::create([
                'package_status' => 'PENDING',
                'countryId' => 148,
                'remarks' => 'AWB generated',
                'date' => now(),
                'location' => $shipment->senderCity,
                'shipmentId' => $shipment->id
            ]);
            $request->session()->flash('success', "Your shipment package added successfully.");
            $url = request()->is('agent/shipment*') ? route('shipment.index') : route('shipmentpackage.index');
            LogActivity::addToLog('New shipment added');
            $shipment->refresh();
            DB::commit();
            if ($shipment->senderEmail) {
                $appsetting = AppSetting::first();

                $details = [
                    'title' => 'Mail from Air Logistic Group',
                    'body' => 'Your courier has been booked successfully . Your AWB number is ' . $shipment->barcode . '. You can track your courier from our website',
                ];
                FacadesMail::to($shipment->senderEmail)->send(new \App\Mail\ShipmanetPackageMail($details));
            }
            if ($request->airway) {
                return $this->generateAWB($shipment->id);
            }
            if ($request->performa) {
                return $this->generateLabel($shipment->id);
            }

            if ($request->cash_invoices) {
                return redirect()->route('cashinvoice.index', ['shipmentId' => $shipment->id]);
            }
            return redirect()->to($url);
        } catch (Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $shipmentPackage_info = $this->shipmentPackage->with('getSender')->with('getStatusLevel')->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        $title = $shipmentPackage_info->package_name . ' Detail';
        $cancellation_reasons = ShipmentCancellationReason::where('publishStatus', 1)->where('usage_by', 1)->pluck('title', 'id');
        $total = $shipmentPackage_info->shipping_charge + $shipmentPackage_info->gov_tax + $shipmentPackage_info->service_agent_charge + $shipmentPackage_info->service_charge;
        return view('admin/shipmentpackage/detail', compact('shipmentPackage_info', 'title', 'total', 'cancellation_reasons'));
    }

    public function edit(Request $request, $id)
    {
        $shipmentPackage_info = $this->shipmentPackage->findorfail($id);

        $title = 'Edit Shipment';
        $serviceAgents = ServiceAgent::where('publishStatus', 1)->pluck('title', 'id');
        $customers = Customer::pluck('name', 'id');
        if (Auth()->user()->agent) {
            $remaining_request = AgentMembershipHistory::where('agentId', auth()->user()->id)
                ->selectRaw('SUM(remainingRequestCount) as remain')
                ->first();
        }
        $url = request()->is('agent/shipment*') ? route('shipment.update', $id) : route('shipmentpackage.update', $id);
        $receiving_country = Country::find($shipmentPackage_info->receiver_country);
        $allDocuments = $shipmentPackage_info->load('shipmentFiles');
        $data =  [
            "title" => $title,
            "shipmentPackage_info" => $shipmentPackage_info,
            "customers" => $customers,
            "packageTypes" => ShipmentPackageType::where('publishStatus', '1')->get()->pluck('package_type', 'id'),
            "serviceAgents" => $serviceAgents,
            "remaining_request" => $remaining_request->remain ?? null,
            "url" => $url,
            'shipmentCharge' => ShipmentCharge::where('shipmentId', $shipmentPackage_info->id)->first(),
            'allDocuments' => $allDocuments,
            'countries' => $this->getCountry()

        ];
        return view('admin/shipmentpackage/form', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        $existingcharge = ShipmentCharge::where('shipmentId', $shipmentPackage_info->id)->first();
        if ($existingcharge) {
            $agentCreditBalance = AgentCreditBalance::where('agentId', $existingcharge->agentId)->first();
            $agentCreditBalance->increment('balance', $existingcharge->total);
            $agentCreditBalance->decrement('consumedCredit', $existingcharge->total);
            $existingcharge->delete();
        }



        // $this->validate($request, $this->shipmentValidate($request, $shipmentPackage_info));
        try {
            $agentId = $request->agentId ?? auth()->user()->agentId ?? auth()->id();
            $credit =   AgentCreditBalance::where('agentId', $agentId)->first();
            if (!$credit) {
                request()->session()->flash('error', 'This Agent Don\'t have Credit. Please contact admin');
                return redirect()->back()->withInput();
            }
            if ($credit->dueDate->lt(now())) {
                request()->session()->flash('error', 'Credit has Expired');
                return redirect()->back()->withInput();
            }
            DB::beginTransaction();
            $data = $this->mapShipmentData($request);
            $data['agentId'] = $agentId;
            $data['billing_account'] =  $request->billing_account ?? optional(User::with('agent_profile')->find($agentId))->agent_profile->company_name;
            $shipmentPackage_info->fill($data)->save();
            if ($request->images) {
                $imageItems = [];
                foreach ($request->images as $image) {
                    $imageItems[] = uploadFile($image, "agents/$agentId/shipments", false, time() . "-" . rand(78888, 99999), false);
                }
                if ($imageItems) {
                    foreach ($imageItems as $key => $value) {
                        ShipmentFile::create([
                            'shipmentId' => $shipmentPackage_info->id,
                            'agentId' => $agentId,
                            'filepath' => $value,
                        ]);
                    }
                }
            }
            $totalWeight = 0;

            ShipmentItems::where('shipmentPackageId', $shipmentPackage_info->id)->delete();

            foreach ($request->piece_number as $key => $value) {
                $items = ShipmentItems::create([
                    'piece_number' => $request->piece_number[$key] ?? 1,
                    'length' => $request->length[$key],
                    'weight' => $request->weight[$key],
                    'height' => $request->height[$key],
                    'width' => $request->width[$key],
                    'volume_weight' => bcdiv(($request->length[$key] * $request->width[$key] * $request->height[$key] * $request->piece_number[$key]) / 5000, 1, 4),
                    'shipmentPackageId' =>  $id,
                ]);
                event(new ShipmentItemsCreated($items));
                $totalWeight += $request->weight[$key];
            }
            $shipmentPackage_info->total_weight = bcdiv($totalWeight, 1, 3);
            $shipmentPackage_info->total_volume_weight = bcdiv($request->total_volume_weight, 1, 3);
            $shipmentPackage_info->total_chargeable_weight = bcdiv($request->total_chargeable_weight, 1, 3);
            $shipmentPackage_info->save();

            $zoneId = ZoneCountryServiceAgent::where('country_id', $shipmentPackage_info->receiverCountryId)->where('serviceagent_id', $shipmentPackage_info->service_agent)->latest()->first();
            // dd($shipmentPackage_info);
            if (!$zoneId) {
                request()->session()->flash('error', 'The Selected country doesn\'t have price included');
                return redirect()->back()->withInput();
            }
            $price = $this->getTotalWeight($shipmentPackage_info->service_agent, $zoneId->zone_id, $shipmentPackage_info->total_chargeable_weight, $agentId);
            if (!$price['price'] || $price['price'] == 0) {
                request()->session()->flash('error', 'The Selected country doesn\'t have price included for given integrator');
                return redirect()->back()->withInput();
            }
            if ($price['price'] > $credit->balance) {
                request()->session()->flash('error', 'Credit Amount is less than the required cost.Contact Admin');
                return redirect()->back()->withInput();
            }
            event(new UpdateCredit($price['price'], $agentId));
            $this->shipmentPackage->where('id', $id)->update(['total_chargeable_weight' => $price['chargeableWeight']]);

            $this->generateShipmentCharge($shipmentPackage_info, $price);

            DB::commit();
            LogActivity::addToLog('shipment updated');
            $url = request()->is('agent/shipment*') ? route('shipment.index') : route('shipmentpackage.index');

            $request->session()->flash('success', "Your shipment package successfully updated.");
            // return redirect()->route('shipment.index');
            return redirect()->to($url);
        } catch (Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        try {
            $shipmentPackage_info->delete();
            LogActivity::addToLog('shipment deleted');

            $request->session()->flash('success', 'Shipment Package deleted successfully.');
            return redirect()->back();
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }


    // << ----------------------  Pending Shipment Actions ---------------------------------->>

    public function approvePackage(Request $request, $id)
    {
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        try {
            $shipmentPackage_info->package_status = 'APPROVED';
            $shipmentPackage_info->approved_by = auth()->user()->id;
            $shipmentPackage_info->approved_at = Carbon::now();
            $shipmentPackage_info->statusId = 2;
            $shipmentPackage_info->save();
            LogActivity::addToLog('shipment approved');
            $request->session()->flash('success', 'Shipment Package approved successfully.');
            return redirect()->route('shipmentpackage.approved');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function declinePackage(Request $request, $id)
    {
        // dd($request->all());
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        try {
            DB::beginTransaction();
            // dd($request->all());
            $shipmentPackage_info->package_status = 'CANCELLED';
            $shipmentPackage_info->cancelled_by_type = 'ADMIN';
            $shipmentPackage_info->cancellation_reason = $request->cancellation_reason;
            $shipmentPackage_info->cancellation_remarks = $request->cancellation_remarks;
            $shipmentPackage_info->cancelled_by = auth()->user()->id;
            $shipmentPackage_info->cancelled_at = Carbon::now();
            $shipmentPackage_info->statusId = 3;
            $shipmentPackage_info->save();

            $request->session()->flash('success', 'Shipment Package cancelled successfully.');
            DB::commit();
            LogActivity::addToLog('shipment decline');
            return redirect()->route('shipmentpackage.cancelled.admin');
        } catch (\Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    // << ----------------------  Approved Shipment Actions ---------------------------------->>

    public function packageReceived(Request $request, $id)
    {
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        try {
            $shipmentPackage_info->package_status = 'RECEIVED';
            $shipmentPackage_info->received_by = auth()->user()->id;
            $shipmentPackage_info->received_at = Carbon::now();
            $shipmentPackage_info->statusId = 4;
            $shipmentPackage_info->save();
            LogActivity::addToLog('shipment received');
            $request->session()->flash('success', 'Shipment Package received successfully.');
            return redirect()->route('shipmentpackage.received');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    // << ----------------------  Received Shipment Actions ---------------------------------->>

    public function schedulePackage(Request $request, $id)
    {
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        $this->validate($request, [
            'airlines' => 'required',
            'scheduled_for' => 'required|date|after:today',
            'flightNumber' => 'required'
        ]);
        try {
            $shipmentPackage_info->scheduled_for = $request->scheduled_for;
            $shipmentPackage_info->airlines = $request->airlines;
            $shipmentPackage_info->flightNumber = $request->flightNumber;
            $shipmentPackage_info->package_status = 'SCHEDULED';
            $shipmentPackage_info->scheduled_by = auth()->user()->id;
            $shipmentPackage_info->scheduled_at = Carbon::now();
            $shipmentPackage_info->statusId = 5;
            $shipmentPackage_info->save();
            $this->generateLocation($shipmentPackage_info->id, 'SCHEDULED');
            LogActivity::addToLog('shipment scheduled');
            $request->session()->flash('success', 'Shipment Package scheduled successfully.');
            return redirect()->route('shipmentpackage.scheduled');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    // << ----------------------  Incargo Shipment Actions ---------------------------------->>

    public function deliveredPackage(Request $request, $id)
    {
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        try {
            $shipmentPackage_info->package_status = 'DELIVERED';
            $shipmentPackage_info->statusId = 10;
            $shipmentPackage_info->save();
            $this->generateLocation($shipmentPackage_info->id, 'DELIVERED');
            LogActivity::addToLog('shipment delivered');
            $request->session()->flash('success', 'Shipment Package delivered successfully.');
            return redirect()->route('shipmentpackage.delivered');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    public function downloadDocument($id)
    {

        $shipmentPackage_info = $this->shipmentPackage->with('shipmentFiles')->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        //  $shipmentPackage_info->load('shipmentFiles');
        //  return view('admin/shipmentpackage/downloaddocs')->with(['package' => $shipmentPackage_info]);
        view()->share(['package' => $shipmentPackage_info]);
        $pdf = PDF::loadView('admin/shipmentpackage/downloaddocs');
        LogActivity::addToLog('download documents');
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream($shipmentPackage_info->awb_number . '.pdf');
    }

    public function generateLabel($id)
    {

        $shipmentPackage_info = $this->shipmentPackage->with('getAgent', 'getItems', 'getSender', 'getReceiver', 'getCharge')->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        // dd($shipmentPackage_info);
        $charge = new ShipmentCharge();
        //  return view('admin/shipmentpackage/label')->with(['package' => $shipmentPackage_info, 'charge' => $charge]);
        view()->share(['package' => $shipmentPackage_info, 'charge' => $charge]);
        $pdf = PDF::loadView('admin/shipmentpackage/label');
        LogActivity::addToLog('generate AWB');
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream($shipmentPackage_info->package_name . ' label.pdf');
    }
    public function generateAWB($id)
    {

        $shipmentPackage_info = $this->shipmentPackage->with('getAgent', 'getItems', 'getSender', 'getReceiver', 'getCharge')->with(['getAgent.agent_profile'])->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        $charge = new ShipmentCharge();
        // return view('admin/shipmentpackage/awbill', compact('shipmentPackage_info','charge'));
        view()->share(['package' => $shipmentPackage_info, 'charge' => $charge]);
        $pdf = PDF::loadView('admin/shipmentpackage/awbill');
        LogActivity::addToLog('generate AWB');
        $pdf->setPaper('A3', 'portrait');
        return $pdf->stream($shipmentPackage_info->package_name . ' Air Waybill.pdf');
    }
    public function generateBulkAWB(Request $request)
    {
        // dd($request->ids);
        $zip = new ZipArchive;
        $filename = date('ymdhis') . 'Air Waybill.zip';
        foreach ($request->ids as $id) {
            // dd($id['ids']);
            $shipmentPackage_info = $this->shipmentPackage->with('getAgent', 'getItems', 'getSender', 'getReceiver', 'getCharge')->find($id);
            if (!$shipmentPackage_info) {
                abort(404);
            }
            $charge = new ShipmentCharge();
            view()->share(['package' => $shipmentPackage_info, 'charge' => $charge]);
            $pdf = PDF::loadView('admin/shipmentpackage/awbill');
            $pdf->setPaper('A3', 'portrait');
            $pdf->save('zip/' . $shipmentPackage_info->package_name . ' Air Waybill.pdf');
        }
        if ($zip->open(public_path($filename), ZipArchive::CREATE) === TRUE) {
            $files = FacadesFile::files(public_path('zip'));
            foreach ($files as $key => $value) {
                $relativename = basename($value);
                // $filesdelete = $value;
                $zip->addFile($value, $relativename);
            }
            $zip->close();
        }
        // dd($files);
        FacadesFile::delete($files);
        LogActivity::addToLog('genrate AWB');
        if (request()->wantsJson()) {
            return response()->file(public_path($filename));
        }

        // return back();
        return response()->download(public_path($filename));
    }

    public function generateAWBMaster($id)
    {
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        view()->share('shipmentPackage_info', $shipmentPackage_info);
        $pdf = PDF::loadView('admin/shipmentpackage/awbillmaster');

        LogActivity::addToLog('generate master AWB');

        return $pdf->download($shipmentPackage_info->package_name . ' Air Waybill Master.pdf');
    }

    public function dispatchPackage(Request $request)
    {

        DB::beginTransaction();

        try {
            $this->shipmentPackage->whereIn('id', $request->ids)->update([
                'package_status' => 'DISPATCHED',
                'dispatched_at' => now(),
                'dispatched_by' => auth()->id(),
                'statusId' => 6,
            ]);

            foreach ($request->ids as $value) {
                $this->generateLocation($value, 'DISPATCHED');
            }

            $request->session()->flash('success', 'AWB number updated & dispatched successfully.');
            DB::commit();
            LogActivity::addToLog('update  AWB number');
        } catch (\Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
        }
    }
    public function trackingcode(Request $request, $id)
    {
        $shipmentPackage_info = $this->shipmentPackage->find($id);
        if (!$shipmentPackage_info) {
            abort(404);
        }
        try {
            DB::beginTransaction();
            $shipmentPackage_info->tracking_code = $request->tracking_code;
            $shipmentPackage_info->package_status = 'INCARGO';
            $shipmentPackage_info->save();
            $request->session()->flash('success', 'Tracking code updated & sent in cargo successfully.');
            DB::commit();
            return redirect()->route('shipmentpackage.incargo');
        } catch (\Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    // << ----------------------  Track Shipment ---------------------------------->>






    public function getCountry()
    {
        return  Country::select('id', 'name')->orderBy('name', 'ASC')->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
    }


    protected function getTotalWeight(int $serviceAgentId, $zone_id, float $weight, $agentId = null)
    {
        $price = DB::table('pricings')
            ->when($agentId, function ($query) use ($agentId) {
                $query->where('pricings.agent_id', $agentId);
            })
            ->join('weight_prices', 'weight_prices.pricing_id', 'pricings.id')
            ->select('weight_prices.weight', 'weight_prices.price')
            ->where('serviceAgentId', $serviceAgentId)
            ->where('zone_id', $zone_id)
            ->where('weight_prices.weight', '>=', $weight)
            ->orderBy('weight_prices.weight', 'asc')
            ->orderBy('pricings.effectiveDate', 'desc')
            ->first();

        return [
            'price' => bcdiv(optional($price)->price, 1, 3),
            'chargeableWeight' => bcdiv(optional($price)->weight ?? 0, 1, 3),
        ];
    }

    public function generateLocation($id, $status)
    {
        return   ShipmentLocation::create(
            [
                'shipmentId' => $id,
                'countryId' => '148',
                'location' => 'Kathmandu',
                'package_status' => $status,
                'statusId' => '1',
            ]
        );
    }


    private function generateShipmentCharge(ShipmentPackage $shipment, array $price)
    {
        ShipmentCharge::create([
            'shipmentId' => $shipment->id,
            'shipping_charge' => $price['price'],
            'total' => $price['price'],
            'agentId' => $shipment->agentId,
            'currency_type' => request('currency_type'),
            'tiaCharge' => bcdiv(request('tiaCharge'), 1, 3),
            'tiaCalculatedCharge' => bcdiv((request('tiaCharge')) * $shipment->total_weight, 1, 3),
            'handling' => bcdiv(request('handling'), 1, 3),
            'handlingCalculated' => bcdiv(request('handling') ? request('handling')  * $shipment->totalPiece : 0, 1, 3),
            'billing' => bcdiv(request('billing'), 1, 3),
            'billingCalculated' => bcdiv(request('billing') ?  $shipment->total_chargeable_weight * request('billing') : 0, 1, 3),
            'packaging' => bcdiv(request('packaging'), 1, 3),
        ]);
    }
}
