<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMwabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mwabs', function (Blueprint $table) {
            $table->id();
            $table->string('mwab');
            $table->unsignedBigInteger('shipmentId');
            $table->string('uniqueMwab');
            $table->timestamps();

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
        Schema::dropIfExists('mwabs');
    }
}
