<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('typeId')->nullable();
            $table->unsignedBigInteger('userId')->nullable();
            $table->dateTime('verifiedAt')->nullable();
            $table->unsignedBigInteger('verifiedBy')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('userId')->on('users')->references('id')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('verifiedBy')->on('users')->references('id')->onUpdate('CASCADE')->onDelete('RESTRICT');
           
            $table->foreign('typeId')->on('type_of_users')->references('id')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
