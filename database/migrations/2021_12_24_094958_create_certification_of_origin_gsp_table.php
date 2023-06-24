<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationOfOriginGspTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_of_origin_gsp', function (Blueprint $table) {
            $table->id();
            $table->string('export_date', 20)->nullable();
            $table->string('issued_address', 20)->nullable();
            $table->string('reference_no', 20)->nullable();
            $table->string('exporter_details', 1000)->nullable();
            $table->string('consignee_details', 1500)->nullable();
            $table->string('transport', 1000)->nullable();
            $table->string('official_use', 1000)->nullable();
            $table->string('declaration_name', 400)->nullable();
            $table->string('declaration_title', 400)->nullable();
            $table->string('declaration_city', 400)->nullable();
            $table->string('item_no', 50)->nullable();
            $table->string('package_marks', 400)->nullable();
            $table->string('description_of_goods', 1000)->nullable();
            $table->string('origin', 300)->nullable();
            $table->string('gross_weight', 100)->nullable();
            $table->string('invoice_data', 1000)->nullable();
            $table->string('produced_country', 100)->nullable();
            $table->string('importing_country')->nullable();
            $table->string('exporter_signature')->nullable();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->timestamps();
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updatedBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certification_of_origin_gsp');
    }
}
