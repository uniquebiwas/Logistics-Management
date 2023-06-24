<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentFilesTable extends Migration
{
    public function up()
    {
        Schema::create('shipment_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipmentId')->nullable();
            $table->unsignedBigInteger('agentId')->nullable();
            $table->string('filepath')->nullable();
            $table->timestamps();
            $table->foreign('agentId')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('shipmentId')->references('id')->on('shipment_packages')->onDelete('CASCADE')->onUpdate('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_files');
    }
}
