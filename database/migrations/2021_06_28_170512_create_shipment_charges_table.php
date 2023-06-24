<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipmentId')
                ->on('shipment_packages')
                ->reference('id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table
                ->double('shipping_charge', 15, 2)
                ->nullable();
            $table
                ->double('service_charge', 15, 2)
                ->nullable();
            $table
                ->double('service_agent_charge', 15, 2)
                ->nullable();
            $table
                ->double('gov_tax', 15, 2)
                ->nullable();
            $table
                ->string('currency_type')
                ->default('NPR');
            $table
            ->unsignedInteger('total')
            ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_charges');
    }
}
