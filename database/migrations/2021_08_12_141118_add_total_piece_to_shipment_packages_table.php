<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalPieceToShipmentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipment_packages', function (Blueprint $table) {
            $table->unsignedTinyInteger('totalPiece')->nullable();
            $table->string('senderName')->nullable();
            $table->string('senderAddress')->nullable();
            $table->string('senderAddress2')->nullable();
            $table->string('senderAddress3')->nullable();
            $table->string('senderCity')->nullable();
            $table->string('senderZipCode')->nullable();
            $table->string('senderCountry')->nullable();
            $table->string('senderMobile')->nullable();
            $table->string('senderEmail')->nullable();
            $table->string('senderState')->nullable();
            $table->string('senderAttention')->nullable();
            $table->string('receiverName')->nullable();
            $table->string('receiverAddress')->nullable();
            $table->string('receiverAddress2')->nullable();
            $table->string('receiverAddress3')->nullable();
            $table->string('receiverCity')->nullable();
            $table->string('receiverZipCode')->nullable();
            $table->string('receiverCountry')->nullable();
            $table->string('receiverMobile')->nullable();
            $table->string('receiverTelephone')->nullable();
            $table->string('receiverEmail')->nullable();
            $table->string('receiverState')->nullable();
            $table->string('receiverConsigneeCode')->nullable();
            $table->string('receiverCompany')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipment_packages', function (Blueprint $table) {
            //
        });
    }
}
