<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNepalFrightForwardersAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nepal_fright_forwarders_associations', function (Blueprint $table) {
            $table->id();
            $table->string('firstRow', 500)->nullable();
            $table->string('shipperDetails', 100)->nullable();
            $table->string('shipmentAccount', 50)->nullable();
            $table->string('consigneeDetails', 100)->nullable();
            $table->string('consigneeAccount', 50)->nullable();
            $table->string('airwayBill', 500)->nullable()->comment('containes Issued By and Accounting Information');
            $table->string('agentDetails', 100)->nullable();
            $table->string('agentCode', 20)->nullable();
            $table->string('agentAccount', 20)->nullable();
            $table->string('airportDepartures', 50)->nullable();
            $table->string('airportTo', 50)->nullable();
            $table->string('carrierRouting', 50)->nullable();
            $table->string('carrierTo', 20)->nullable();
            $table->string('carrierBy', 20)->nullable();
            $table->string('carrierTo2', 20)->nullable();
            $table->string('carrierBy2', 20)->nullable();
            $table->string('airportDestination', 50)->nullable();
            $table->string('requestedFlight', 50)->nullable();
            $table->string('requestedDate', 50)->nullable();
            $table->string('referenceNumber', 50)->nullable();
            $table->string('optionalShippingInformation', 60)->nullable();
            $table->string('currency', 20)->nullable();
            $table->string('code', 20)->nullable();
            $table->string('valppd', 20)->nullable();
            $table->string('valcoll', 20)->nullable();
            $table->string('otherppd', 20)->nullable();
            $table->string('othercoll', 20)->nullable();
            $table->string('carriageValue', 50)->nullable();
            $table->string('customerValue', 50)->nullable();
            $table->string('insuranceAmount', 50)->nullable();
            $table->string('handilingInformation', 100)->nullable();
            $table->string('sci', 20)->nullable();
            $table->string('piecesNumber', 50)->nullable();
            $table->string('grossWeight', 50)->nullable();
            $table->string('kg', 5)->nullable();
            $table->string('rateClass', 5)->nullable();
            $table->string('commodity', 50)->nullable();
            $table->string('chargeableWeight', 50)->nullable();
            $table->string('rate', 50)->nullable();
            $table->string('total', 50)->nullable();
            $table->string('nature', 50)->nullable();
            $table->text('wholeTotal', 900)->nullable();
            $table->string('prepaidWeightCharge', 20)->nullable();
            $table->string('prepaidValuationCharge', 20)->nullable();
            $table->string('prepaidTax', 20)->nullable();
            $table->string('prepaidDueAgent', 20)->nullable();
            $table->string('prepaidDueCarrier', 20)->nullable();
            $table->string('totalPrepaid', 10)->nullable();
            $table->string('collectWeightCharge', 20)->nullable();
            $table->string('collectValuationCharge', 20)->nullable();
            $table->string('collectTax', 20)->nullable();
            $table->string('collectDueAgent', 20)->nullable();
            $table->string('collectDueCarrier', 20)->nullable();
            $table->string('totalCollect', 20)->nullable();
            $table->text('information', 1000)->nullable();
            $table->string('currencyConversion', 50)->nullable();
            $table->string('ccDestinationCharge', 50)->nullable();
            $table->string('destinationCharge', 50)->nullable();
            $table->string('totalCollectCharge', 50)->nullable();
            $table->string('bottomCode')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('updatedBy')->nullable();
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
        Schema::dropIfExists('nepal_fright_forwarders_associations');
    }
}
