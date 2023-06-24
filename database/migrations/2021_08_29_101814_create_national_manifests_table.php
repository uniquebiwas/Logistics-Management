<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_manifests', function (Blueprint $table) {
            $table->id();
            $table->string('manifestNumber')->unique();
            $table->string('client')->nullable();
            $table->string('clientLocation')->nullable();
            $table->longText('remarks')->nullable();
            $table->double('total', 15, 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('national_manifests');
    }
}
