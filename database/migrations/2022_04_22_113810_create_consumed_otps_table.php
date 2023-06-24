<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumedOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumed_otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId')->nullable();
            $table->string('otp')->nullable();
            $table->unsignedBigInteger('mobile')->nullable();
            $table->string('token')->nullable();
            $table->string('purpose')->nullable();
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumed_otps');
    }
}
