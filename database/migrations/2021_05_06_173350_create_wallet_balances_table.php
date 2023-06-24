<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agentId')->index()->nullable();
            $table->double('balance', 15,2)->nullable();
            $table->timestamps();
            $table->foreign('agentId')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_balances');
    }
}
