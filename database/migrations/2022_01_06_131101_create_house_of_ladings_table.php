<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseOfLadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_of_ladings', function (Blueprint $table) {
            $table->id();
            $table->string('hblNumber', 100)->nullable();
            $table->string('shipmentReferenceNumber', 100)->nullable();
            $table->string('shipper', 500)->nullable();
            $table->string('consignee', 500)->nullable();
            $table->string('notify', 500)->nullable();
            $table->string('preCarriageBy', 500)->nullable();
            $table->string('transportMode', 500)->nullable();
            $table->string('placeOfReceipt', 500)->nullable();
            $table->string('portOfLoading', 500)->nullable();
            $table->string('portOfDischarge', 500)->nullable();
            $table->string('portOfDelivery', 500)->nullable();
            $table->string('vesselVoyNumber', 500)->nullable();
            $table->string('containerNo', 500)->nullable();
            $table->string('marksAndNumbers', 500)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('grossWeight', 50)->nullable();
            $table->string('measurement', 100)->nullable();
            $table->string('freightAmount', 50)->nullable();
            $table->string('freightPayable', 50)->nullable();
            $table->string('numberOfOriginalHbl', 50)->nullable();
            $table->string('issueDate', 100)->nullable();
            $table->string('others', 500)->nullable();
            $table->string('lastPart', 500)->nullable();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('updatedBy')->nullable();

            $table->timestamps();

            $table->foreign('createdBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updatedBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_of_ladings');
    }
}
