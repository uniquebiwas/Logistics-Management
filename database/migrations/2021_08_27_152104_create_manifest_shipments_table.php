<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifest_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifestId');
            $table->unsignedBigInteger('shipmentId');
            $table->timestamps();
            $table->foreign('manifestId')->on('manifests')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('manifest_shipments');
    }
}
