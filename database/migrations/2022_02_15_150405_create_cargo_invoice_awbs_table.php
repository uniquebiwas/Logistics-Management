<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoInvoiceAwbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_invoice_awbs', function (Blueprint $table) {
            $table->id();
            $table->string('particulars')->nullable();
            $table->string('service')->nullable();
            $table->string('awbNumber')->nullable();
            $table->string('awbDate')->nullable();
            $table->string('destination')->nullable();
            $table->decimal('pcs', 10, 2)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->unsignedBigInteger('invoice_id');
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('cargo_invoices')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo_invoice_awbs');
    }
}
