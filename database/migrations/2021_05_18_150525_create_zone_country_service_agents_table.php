<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneCountryServiceAgentsTable extends Migration
{
    public function up()
    {
        Schema::create('zone_country_service_agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serviceagent_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();

            $table->timestamps();
            $table->foreign('serviceagent_id')->references('id')->on('service_agents')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('zone_id')->references('id')->on('shipment_zones')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('zone_country_service_agents');
    }
}
