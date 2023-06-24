<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('serviceAgentId')->nullable();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->boolean('publishStatus')->default(true);
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('zone_id')->references('id')->on('shipment_zones')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('serviceAgentId')->references('id')->on('service_agents')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updatedBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricings');
    }
}
