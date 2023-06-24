<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalManifestBagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_manifest_bags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('barcode');
            $table->unsignedBigInteger('manifestId')->nullable();
            $table->timestamps();
            $table->foreign('manifestId')->on('manifests')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('national_manifest_bags');
    }
}
