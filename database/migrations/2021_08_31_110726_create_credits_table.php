<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->dateTime('dueDate');
            $table->unsignedBigInteger('agentId');
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->unsignedBigInteger('creditAmount')->default(0);
            $table->unsignedBigInteger('useCredit')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('agentId')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('createdBy')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('updatedBy')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credits');
    }
}
