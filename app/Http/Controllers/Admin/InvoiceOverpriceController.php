<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\ServiceAgent;
use App\Models\ShipmentCharge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceOverpriceController extends Controller
{
    public function edit($id)
    {
        $invoice = Invoice::with('shipmentPackages')->findorfail($id);
        $agentList = $this->getAgent();
        $selectedShipment = optional($invoice->shipmentPackages)->pluck('id');
        $serviceAgents = ServiceAgent::get()->pluck('title', 'id');
        $uniqueBillingAccount = DB::table('shipment_packages')->where('billing_account', '<>', NULL)->select('billing_account')->distinct()->get()->pluck('billing_account');


        return view('admin.invoice.overweightInvoice', compact('invoice', 'selectedShipment', 'agentList', 'serviceAgents', 'uniqueBillingAccount'));
    }

    public function createInvoice(InvoiceRequest $request, $id)
    {
        $invoice = Invoice::findorfail($id);
        $validateData = $request->validated();
        $sync = collect($validateData['shipmentId'])->mapWithKeys(function ($item) use ($validateData) {
            return [
                $item => [
                    'rates' => $validateData['rates'][$item],
                    'weights' => $validateData['weights'][$item],
                ],
            ];
        })->toArray();
        DB::beginTransaction();
        try {
            $data =   $invoice->replicate();
            $data['referenceNumber'] = $invoice->referenceNumber ?? $invoice->id;
            $data['invoiceNumber'] = $this->generateInvoiceNumber();
            $data['oversizeCharge'] = $validateData['oversizeCharge'];
            $data['overweightCharge'] = $validateData['overweightCharge'];
            $data['remoteareaDeliveryCharge'] = $validateData['remoteareaDeliveryCharge'];
            $data->save();
            $data->refresh();
            $data->shipmentPackages()->sync($sync);
            $data->update($this->setZero());
            DB::commit();
            request()->session()->flash('sucess', 'The Invoice has been created successfully');
            return redirect()->route('invoice.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function getAgent()
    {
        return User::with('roles')->with('agent_profile')->get()->filter(function ($user, $key) {
            return $user->hasRole('Agent');
        })->mapWithKeys(function ($agent) {
            return [$agent->id => $agent->agent_profile->company_name ??  $agent->name['en']];
        });
    }
    protected function generateInvoiceNumber()
    {
        $latest = Invoice::selectRaw('invoiceNumber as latest')->where('invoiceNumber', '<>', null)->orderBy('id', 'desc')->first();
        if (!$latest) {
            return 1000;
        }
        return (int)$latest->latest + 1;
    }

    protected function getShipmentCharge($shipmentId)
    {
        return ShipmentCharge::where('shipmentId', $shipmentId)
            ->join('shipment_packages', 'shipment_packages.id', 'shipment_charges.shipmentId')
            ->selectRaw('shipment_charges.shipping_charge/shipment_packages.total_chargeable_weight as rates')
            ->value('rates');
    }

    protected function setZero()
    {
        return [
            'tiaCharge' => 0,
            'customClearingCharge' => 0,
            'shipmentPackageCharge' => 0,
            'perPackageCharge' => 0,
            'insuranceCharge' => 0,
            'detentionCharge' => 0,
            'goodsPickupCharge' => 0,
            'cargoLoadingCharge' => 0,
            'fumigationCharge' => 0,
            'documentationHandlingCharge' => 0,
            'shipmentHandelingCharge' => 0,
            'demurrage' => 0,
            'roundOff' => 0,
            'surcharge' => 0,
        ];
    }
}
