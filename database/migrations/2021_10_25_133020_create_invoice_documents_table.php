<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoiceId')->nullable();
            $table->unsignedBigInteger('verifiedBy')->nullable();
            $table->dateTime('verifiedAt')->nullable();
            $table->string('document')->nullable();
            $table->double('total')->default(0);
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('invoiceId')->on('invoices')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('verifiedBy')->on('users')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_documents');
    }
}
