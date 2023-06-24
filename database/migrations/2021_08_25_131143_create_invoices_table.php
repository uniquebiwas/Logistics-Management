<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNumber')->nullable()->unique();
            $table->boolean('cancel')->default(false);
            $table->dateTime('date')->nullable();
            $table->string('vatNumber')->nullable();
            $table->string('customerAccount')->nullable();
            $table->string('telephone')->nullable();
            $table->string('customerName')->nullable();
            $table->string('address')->nullable();
            $table->date('dueDate')->nullable();
            $table->enum('paymentType', ['cash', 'cheque', 'credit'])->default('cash');
            $table->unsignedBigInteger('serviceId')->nullable();
            $table->unsignedBigInteger('agentId')->nullable();
            $table->string('chequeNumber')->nullable();
            $table->string('customerVatNumber')->nullable();
            $table->decimal('basicTotal', 10, 2)->default(0);
            $table->decimal('fuelCharge', 10, 2)->default(0);
            $table->decimal('tiaCharge', 10, 2)->default(0);
            $table->decimal('customClearingCharge', 10, 2)->default(0);
            $table->decimal('shipmentPackageCharge', 10, 2)->default(0);
            $table->decimal('shipmentHandelingCharge', 10, 2)->default(0);
            $table->decimal('documentationHandlingCharge', 10, 2)->default(0);
            $table->decimal('demurrage', 10, 2)->default(0);
            $table->decimal('perPackageCharge', 10, 2)->default(0);
            $table->decimal('insuranceCharge', 10, 2)->default(0);
            $table->decimal('detentionCharge', 10, 2)->default(0);
            $table->decimal('goodsPickupCharge', 10, 2)->default(0);
            $table->decimal('cargoLoadingCharge', 10, 2)->default(0);
            $table->decimal('oversizeCharge', 10, 2)->default(0);
            $table->decimal('overweightCharge', 10, 2)->default(0);
            $table->decimal('remoteareaDeliveryCharge', 10, 2)->default(0);
            $table->decimal('fumigationCharge', 10, 2)->default(0);
            $table->decimal('roundOff', 10, 2)->default(0);
            $table->decimal('surcharge', 10, 2)->default(0);
            $table->double('AWBtotal')->default(0);
            $table->longText('remarks')->nullable();
            $table->boolean('paymentStatus')->default(false);
            $table->decimal('weightDifferenceCharge', 10, 2)->default(0)->nullable();
            $table->unsignedBigInteger('referenceNumber')->nullable();
            $table->foreign('referenceNumber')->on('invoices')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('agentId')->on('users')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('serviceId')->on('service_agents')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
        DB::update("ALTER TABLE invoices AUTO_INCREMENT= 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
