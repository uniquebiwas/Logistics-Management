<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalManifestPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_manifest_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nationalManifestId');
            $table->unsignedBigInteger('shipmentId');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('nationalManifestId')->on('national_manifests')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('national_manifest_packages');
    }
}
