<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('walletId')->nullable();
            $table->unsignedBigInteger('agentId')->nullable();
            $table->unsignedBigInteger('amount')->nullable()->comment('Requested Amount');
            $table->unsignedBigInteger('approved_amount')->nullable();
            $table->string('image')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('paymentGateway')->nullable();
            $table->string('transactionId')->nullable()->comment('Verified token or voucher number');
            $table->enum('type', ['credited', 'debited']);
            $table->enum('status', ['pending', 'verified']);
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('verifiedBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('verifiedBy')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('walletId')->references('id')->on('wallet_balances')->onDelete('SET NULL')->onUpdate('CASCADE');
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
        Schema::dropIfExists('wallet_transactions');
    }
}
