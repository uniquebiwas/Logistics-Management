<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoiceId');
            $table->unsignedBigInteger('shipmentId');
            $table->decimal('rates',10,2)->nullable();
            $table->decimal('weights',10,3)->nullable();
            $table->tinyInteger('particular')->default(1);
            $table->timestamps();
            $table->foreign('invoiceId')->on('invoices')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('shipmentId')->on('shipment_packages')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_shipments');
    }
}
