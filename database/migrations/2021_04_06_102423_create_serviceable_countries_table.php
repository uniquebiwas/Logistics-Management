<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceableCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceable_countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('countryId')->nullable();
            $table->unsignedBigInteger('addedBy')->nullable();
            $table->timestamps();
            $table->foreign('countryId')->references('id')->on('countries')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('addedBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serviceable_countries');
    }
}
