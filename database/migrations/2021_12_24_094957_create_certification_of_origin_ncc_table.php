<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateCertificationOfOriginNccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_of_origin_ncc', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no', 20)->nullable();
            $table->string('exporter_details', 1000)->nullable();
            $table->string('exporter_registration_no', 400)->nullable();
            $table->string('firm_registration_no', 60)->nullable();
            $table->string('place_and_data', 400)->nullable();
            $table->string('consignee_details', 1500)->nullable();
            $table->string('transport', 1000)->nullable();
            $table->string('license_no', 1000)->nullable();
            $table->string('declaration_name', 400)->nullable();
            $table->string('declaration_title', 400)->nullable();
            $table->string('declaration_city', 400)->nullable();
            $table->string('package_marks', 400)->nullable();
            $table->string('description_of_goods', 1000)->nullable();
            $table->string('value', 300)->nullable();
            $table->string('currency', 15)->nullable();
            $table->string('unit', 20)->nullable();
            $table->string('value_in_words', 200)->nullable();
            $table->string('quantity', 100)->nullable();
            $table->string('production', 1000)->nullable();
            $table->string('invoice_data', 1000)->nullable();
            $table->string('export_date', 20)->nullable();
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
        Schema::dropIfExists('certification_of_origin_ncc');
    }
}
