<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Controllers\Controller;
use App\Http\Requests\CargoInvoiceRequest;
use App\Models\CargoInvoice;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade  as PDF;
use NumberFormatter;

class CargoInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = CargoInvoice::latest()->paginate(20);
        return view('admin.cargo.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new CargoInvoice();
        $agentList = $this->getAgent();
        $uniqueBillingAccount = DB::table('shipment_packages')->where('billing_account', '<>', NULL)->select('billing_account')->distinct()->get()->pluck('billing_account');
        return view('admin.cargo.invoice.form', compact('invoice', 'agentList', 'uniqueBillingAccount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoInvoiceRequest $request)
    {
        $data = $request->validated();
        $data['invoiceNumber'] = $this->generateInvoiceNumber();
        DB::beginTransaction();
        try {
            $awbData = $this->syncData($data);
            $invoice = CargoInvoice::create($data);
            foreach ($awbData as $key => $value) {
                $invoice->awbs()->create($value);
            }
            DB::commit();
            request()->session()->flash('success', 'Invoice Added Successfully');
            return redirect()->route('cargo-invoice.index');
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $invoice = CargoInvoice::with('awbs')->findorfail($id);
        view()->share(['invoice' => $invoice, 'format' => $format]);
        $pdf = PDF::loadView('admin.cargo.invoice.test');
        $pdf->setPaper('A3', 'potrait');
        return $pdf->stream($invoice->id . 'Invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice =  CargoInvoice::findorfail($id);
        $agentList = $this->getAgent();
        $uniqueBillingAccount = DB::table('shipment_packages')->where('billing_account', '<>', NULL)->select('billing_account')->distinct()->get()->pluck('billing_account');
        return view('admin.cargo.invoice.form', compact('invoice', 'agentList', 'uniqueBillingAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CargoInvoiceRequest $request, $id)
    {
        $cargoInvoice = CargoInvoice::findorfail($id);
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $awbData  =  $this->syncData($data);
            $cargoInvoice->update($data);
            $cargoInvoice->awbs()->delete();
            foreach ($awbData as $key => $value) {
                $cargoInvoice->awbs()->create($value);
            }
            DB::commit();
            request()->session()->flash('success', 'Invoice Added Successfully');
            return redirect()->route('cargo-invoice.index');
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    protected function generateInvoiceNumber(): int
    {
        $invoiceMax = DB::table('invoices')->max('invoiceNumber');
        $cargoMax  = DB::table('cargo_invoices')->max('invoiceNumber');
        if ($invoiceMax == 0 && $cargoMax == 0) {
            return 5106;
        }
        return $invoiceMax > $cargoMax ? $invoiceMax + 1 : $cargoMax + 1;
    }

    public function getAgent()
    {
        return User::with('roles')->with('agent_profile')->get()->filter(function ($user, $key) {
            return $user->hasRole('Agent');
        })->mapWithKeys(function ($agent) {
            return [$agent->id => $agent->agent_profile->company_name ??  $agent->name['en']];
        });
    }

    private function deleteArray(&$data): void
    {
        unset(
            $data['particulars'],
            $data['service'],
            $data['awbNumber'],
            $data['awbDate'],
            $data['consignee'],
            $data['destination'],
            $data['pcs'],
            $data['weight'],
            $data['rate'],
            $data['amount']
        );
    }

    private function syncData(&$data)
    {
        foreach (range(0, count($data['particulars'])) as $i) {
            if (!isset($data['particulars'][$i])) {
                break;
            }
            $latestData[] = [
                'particulars' => $data['particulars'][$i],
                'service' => $data['service'][$i],
                'awbNumber' => $data['awbNumber'][$i],
                'awbDate' => $data['awbDate'][$i],
                'consignee' => $data['consignee'][$i],
                'destination' => $data['destination'][$i],
                'pcs' => $data['pcs'][$i],
                'weight' => $data['weight'][$i],
                'rate' => $data['rate'][$i],
                'amount' => $data['amount'][$i],
            ];
        }

        $this->deleteArray($data);
        return $latestData;
    }
    public function changePaymentStatus(Request $request, $id)
    {

        $invoice = CargoInvoice::findorfail($id);
        DB::beginTransaction();
        try {
            $invoice->update(['paymentStatus' => true]);
            DB::commit();
            request()->session()->flash('success', 'Invoice Payment Status Changed Successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('error', 'Invoice Payment Cannot be changed');
            return redirect()->back();
        }
    }
}
