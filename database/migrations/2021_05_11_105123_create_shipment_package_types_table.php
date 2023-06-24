<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentPackageTypesTable extends Migration
{
    public function up()
    {
        Schema::create('shipment_package_types', function (Blueprint $table) {
            $table->id();
            $table->string('package_type');
            $table->string('image')->nullable();
            $table->boolean('publishStatus')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_package_types');
    }
}
