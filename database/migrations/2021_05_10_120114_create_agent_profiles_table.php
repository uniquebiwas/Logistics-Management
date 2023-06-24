<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('agent_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('designation')->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->unsignedBigInteger('userId')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('slug')->nullable();
            $table->string('company_logo_url')->nullable();
            $table->string('vatNumber')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('userId')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_profiles');
    }
}
