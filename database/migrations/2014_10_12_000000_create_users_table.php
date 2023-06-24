<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('mobile', 20)->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('slug')->nullable();
            $table->timestamp('phoneVerifiedAt')->nullable();
            $table->timestamp('emailVerifiedAt')->nullable();
            $table->timestamp('documentVerifiedAt')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('referralCode')->nullable();
            $table->string('referral')->nullable();
            $table->string('profileImage')->nullable();
            $table->string('permanentAddress')->nullable();
            $table->unsignedBigInteger('agentId')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->foreign('agentId')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
