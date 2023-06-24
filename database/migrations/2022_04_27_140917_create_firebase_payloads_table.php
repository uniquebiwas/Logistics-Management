<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirebasePayloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firebase_payloads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adminId')->nullable();
            $table->unsignedBigInteger('senderId')->nullable();
            $table->unsignedBigInteger('receiverId')->nullable();
            $table->string('messageId')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('senderId')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('receiverId')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('adminId')->references('id')->on('admins')->onDelete('CASCADE')->onUpdate('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firebase_payloads');
    }
}
