<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentCancellationReasonsTable extends Migration
{
    public function up()
    {
        Schema::create('shipment_cancellation_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('publishStatus')->default(true);
            $table->boolean('usage_by')->default(false)->comment('1 for admin and 0 for agent');
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updatedBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_cancellation_reasons');
    }
}
