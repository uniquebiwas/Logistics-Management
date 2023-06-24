<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->id();
            $table->string('piece_number')->nullable();
            $table->string('package_number')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->double('quantity')->nullable();
            $table->double('length');
            $table->double('weight');
            $table->double('height');
            $table->double('width');
            $table->double('volume_weight')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('shipmentPackageId')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('shipmentPackageId')->references('id')->on('shipment_packages')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_items');
    }
}
