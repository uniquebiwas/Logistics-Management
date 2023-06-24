<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('weight')->nullable();
            $table->double('price')->nullable();
            $table->unsignedBigInteger('pricing_id')->nullable();
            $table->timestamps();
            $table->foreign('pricing_id')->references('id')->on('pricings')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_prices');
    }
}
