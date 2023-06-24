<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipmentId');
            $table->unsignedBigInteger('countryId')->nullable();
            $table->unsignedBigInteger('location')->nullable();
            $table->text('remarks')->nullable();
            $table->string('package_status')->nullable();
            $table->timestamps();
            $table->foreign('countryId')->on('countries')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('shipmentId')->on('shipment_packages')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_locations');
    }
}
