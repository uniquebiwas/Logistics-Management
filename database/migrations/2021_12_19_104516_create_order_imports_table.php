<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_imports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipmentId');
            $table->softDeletes();
            $table->string('vendor', 20)->nullable();
            $table->string('pool_id')->nullable();
            $table->string('status')->nullable();
            $table->boolean('allocated')->default(false);
            $table->foreign('shipmentId')
                ->on('shipment_packages')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('order_imports');
    }
}
