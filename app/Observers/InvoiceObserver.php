<?php

namespace App\Observers;

use App\Models\Invoice;

class InvoiceObserver
{
    public $afterCommit = true;
    /**
     * Handle the Invoice "created" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        // $invoice->invoiceNumber = $this->generateInvoiceNumber();
        // // $invoice->AWBtotal = $invoice->getShipmentTotalCharge();
        // $invoice->save();
    }

    /**
     * Handle the Invoice "updated" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        // $invoice->AWBtotal = $invoice->getShipmentTotalCharge();
        // $invoice->save();
    }

    /**
     * Handle the Invoice "deleted" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        //
    }
    protected function generateInvoiceNumber()
    {
        $latest = Invoice::selectRaw('invoiceNumber as latest')->where('invoiceNumber', '<>', null)->orderBy('id', 'desc')->first();
        if (!$latest) {
            return 1000;
        }
        return (int)$latest->latest + 1;
    }
}
