<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('load_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipmentId')->references('id')->on('shipment_packages')->constrained()->unique();
            $table->foreignId('loadId')->references('id')->on('loads')->constrained();
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
        Schema::dropIfExists('load_shipments');
    }
}
