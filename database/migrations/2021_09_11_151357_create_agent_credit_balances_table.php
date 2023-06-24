<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCreditBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_credit_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agentId');
            $table->double('balance','8,2')->default(0);
            $table->double('consumedCredit','8,2')->default(0);
            $table->double('paidCredit','8,2')->default(0);
            $table->dateTime('dueDate');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('agentId')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_credit_balances');
    }
}
