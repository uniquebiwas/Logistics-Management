<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportShipmentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_shipment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('shipment_ids')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
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
        Schema::dropIfExists('export_shipment_packages');
    }
}
