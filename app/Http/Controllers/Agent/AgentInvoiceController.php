<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDocument;
use Illuminate\Http\Request;
use NumberFormatter;
use Barryvdh\DomPDF\Facade  as PDF;
use Illuminate\Support\Facades\DB;


class AgentInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $data = Invoice::where('agentId', auth()->user()->agentId ?? auth()->id())
            ->when(isset($request->paymentStatus), function ($query) use ($request) {
                return $query->where('paymentStatus', $request->paymentStatus);
            })->latest()->with('parentInvoice')->paginate(15);
        return view('agent.invoice.agentInvoice', compact('data', 'format'));
    }

    public function show($id)
    {

        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $invoice = Invoice::findorfail($id);
        if (!in_array($invoice->agentId, [auth()->user()->agentId,auth()->id()])) {
            abort(403);
        }
        view()->share(['invoice' => $invoice, 'format' => $format]);
        $pdf = PDF::loadView('admin.invoice.test');
        $pdf->setPaper('A3', 'potrait');
        return $pdf->stream($invoice->id . 'Invoice.pdf');
    }

    public function documentShow($id)
    {
        $invoice = Invoice::with('invoiceDocument')->findorfail($id);

        if (!in_array($invoice->agentId, [auth()->user()->agentId,auth()->id()])) {

            abort(403);
        }
        $documents = InvoiceDocument::where('invoiceId', $invoice->id)->first();
        if ($documents) {
                $documents->document = asset("$documents->document");
           
        }
      

        $data = [
            "title" => "Update Documents",
            "document" => $documents,
            "invoice" => $invoice
        ];
        return view('agent.invoice.documents',$data);
    }
    public function submitDocuments(Request $request)
    {
        $invoice = Invoice::with('invoiceDocument')->findorfail($request->invoiceId);
        if (!in_array($invoice->agentId, [auth()->user()->agentId,auth()->id()])) {
            abort(403);
        }
        DB::beginTransaction();
        try {
            $this->updatedocs($request,  $invoice);
            DB::commit();
            $request->session()->flash('success', 'Your document uploaded successfully.');
            return redirect()->route('agent-invoice');
            //code...
        } catch (Exception $error) {
            DB::rollback();
            $request->session('error', 'There is an error while uploading document, please try again later.');
            return redirect()->back();
        }
    }
    protected function updatedocs($request, $invoice)
    {
        $data = [];
        if ($request->document) {
            $document = uploadFile($request->document, "invoices/$invoice->id/documents", false, "document", false);

            if ($document) {
                $document_data = [
                    'invoiceId' =>  $invoice->id,
                    'verifiedBy' => null,
                    'verifiedAt' => null,
                    'status' => false,
                    'document' => $document,

                ];

                $document = InvoiceDocument::where('invoiceId', $invoice->id)->first();
                if ($document) {
                    $document->fill($document_data)->save();
                } else {
                    $document = InvoiceDocument::create($document_data);
                }
            }
        }
    }

}
