<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\ServiceAgent;
use App\Models\User;
use Barryvdh\DomPDF\Facade  as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberFormatter;
use App\Traits\Shared\AdminSharedTrait;
use App\Models\ZoneCountryServiceAgent;
use App\Models\Country;
use App\Models\Agent\ShipmentPackage;
use App\Models\AgentCreditBalance;

class InvoiceController extends Controller
{
    use AdminSharedTrait;

    public function __construct(Invoice $invoice)
    {
        $this->middleware(['permission:invoice-list'], ['only' => ['index']]);
        $this->middleware(['permission:invoice-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:invoice-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:invoice-delete'], ['only' => ['delete']]);
        $this->middleware(['permission:invoice-show'], ['only' => ['show']]);
        $this->middleware(['permission:invoice-payment-status'], ['only' => ['changePaymentStatus']]);
        $this->invoice = $invoice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd('here');
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $data = Invoice::latest()
            ->with('invoiceDocument')
            ->when(isset($request->paymentStatus), function ($query) use ($request) {
                return $query->where('paymentStatus', $request->paymentStatus);
            })
            ->with('parentInvoice')
            ->paginate(15);
        return view('admin.invoice.index', compact('data', 'format'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();
        $selectedShipment = collect([]);
        $agentList = $this->getAgent();
        $uniqueBillingAccount = DB::table('shipment_packages')->where('billing_account', '<>', NULL)->select('billing_account')->distinct()->get()->pluck('billing_account');
        $serviceAgents = ServiceAgent::get()->pluck('title', 'id');

        return view('admin.invoice.form', compact('invoice', 'selectedShipment', 'agentList', 'serviceAgents', 'uniqueBillingAccount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $data = $request->validated();

        $shipmentId = $data['shipmentId'];
        $sync = collect($data['shipmentId'])->mapWithKeys(function ($item) use ($data) {
            return [
                $item => [
                    'rates' => bcdiv($data['rates'][$item], 1, 3),
                    'weights' => $data['weights'][$item],
                ],
            ];
        })->toArray();
        unset($data['shipmentId']);
        unset($data['rates']);
        unset($data['weights'],  $data['particular']);

        DB::beginTransaction();
        try {
            $data['invoiceNumber'] = $this->generateInvoiceNumber();
            $invoice = Invoice::create($data);

            $invoice->shipmentPackages()->sync($sync);
            $total = $this->getTiaCharge($invoice);
            $invoice->update(['tiaCharge' => $total, 'AWBtotal' => $invoice->getShipmentTotalCharge()]);
            foreach ($shipmentId as $id) {
                ShipmentPackage::find($id)->update(['invoice' => true]);
            }

            DB::commit();
            request()->session()->flash('sucess', 'The Invoice has been created successfully');
            return redirect()->route('invoice.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back();
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
        $invoice = Invoice::findorfail($id);
        view()->share(['invoice' => $invoice, 'format' => $format]);
        $pdf = PDF::loadView('admin.invoice.test');
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
        $invoice = Invoice::with('shipmentPackages')->findorfail($id);
        $agentList = $this->getAgent();
        $selectedShipment = optional($invoice->shipmentPackages)->pluck('id');
        $uniqueBillingAccount = DB::table('shipment_packages')->where('billing_account', '<>', NULL)->select('billing_account')->distinct()->get()->pluck('billing_account');
        $serviceAgents = ServiceAgent::get()->pluck('title', 'id');

        return view('admin.invoice.form', compact('invoice', 'selectedShipment', 'agentList', 'serviceAgents', 'uniqueBillingAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
        $invoice = Invoice::findorfail($id);
        $data = $request->validated();
        $shipmentId = $data['shipmentId'];
        $sync = collect($data['shipmentId'])->mapWithKeys(function ($item) use ($data) {
            return [
                $item => [
                    'particular' => (int) $data['particular'][$item],
                    'rates' => bcdiv($data['rates'][$item], 1, 3),
                    'weights' => $data['weights'][$item],
                ],
            ];
        })->toArray();

        unset($data['shipmentId']);
        unset($data['rates']);
        unset($data['weights'],  $data['particular']);

        DB::beginTransaction();
        try {
            $invoice->update($data);
            $invoice->shipmentPackages()->update(['invoice' => false]);
            $invoice->shipmentPackages()->sync($sync);
            ShipmentPackage::whereIn('id', $shipmentId)->update(['invoice' => true]);

            DB::commit();
            request()->session()->flash('sucess', 'The Invoice has been created successfully');
            return redirect()->route('invoice.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back();
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
    }

    public function getAgent()
    {
        return User::with('roles')->with('agent_profile')->get()->filter(function ($user, $key) {
            return $user->hasRole('Agent');
        })->mapWithKeys(function ($agent) {
            return [$agent->id => $agent->agent_profile->company_name ??  $agent->name['en']];
        });
    }


    public function invoicedShipment(Request $request)
    {
        $invoiced = ShipmentPackage::query()
            ->when($request->keyword, function ($query) use ($request) {
                $query->where('awb_number', 'like', "%$request->keyword%");
            })
            ->when($request->startDate, function ($query) use ($request) {
                $query->where('shipment_date', $request->startDate);
            })
            ->when($request->endDate, function ($query) use ($request) {
                $query->where('shipment_date', $request->endDate);
            })

            ->with('getSender')
            ->where('invoice', 1)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        $data = [
            'title' => 'Invoiced Package',
            'data' => $invoiced,
            'serviceAgent' => ServiceAgent::orderBy('title', 'Asc')->get()->pluck('title', 'id'),
        ];
        return view('admin/shipmentpackage/list', $data);
    }

    protected function getDueDate($agentId)
    {
        $dueDate = AgentCreditBalance::where('agentId', $agentId)->first();

        return optional($dueDate)->dueDate;
    }

    public function overweight($id)
    {
    }


    public function changePaymentStatus(Request $request, $id)
    {

        $invoice = Invoice::findorfail($id);
        DB::beginTransaction();
        try {
            $invoice->update(['paymentStatus' => true]);
            $invoice->invoiceDocument()->update(['verifiedAt' => now(), 'verifiedBy' => auth()->id()]);
            DB::commit();
            request()->session()->flash('success', 'Invoice Payment Status Changed Successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('error', 'Invoice Payment Cannot be changed');
            return redirect()->back();
        }
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



    protected function getTiaCharge(Invoice $invoice)
    {
        return DB::table('shipment_charges')->whereIn('shipmentId', $invoice->shipmentPackages()->get()->pluck('id'))->sum('tiaCalculatedCharge');
    }
}
