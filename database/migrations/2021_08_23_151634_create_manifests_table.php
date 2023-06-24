<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifests', function (Blueprint $table) {
            $table->id();
            $table->string('manifest_number');
            $table->string('origin')->default('kathmandu Nepal');
            $table->string('client')->nullable();
            $table->string('clientLocation')->nullable();
            $table->string('flightNumber');
            $table->string('airlines')->nullable();
            $table->string('shipper');
            $table->string('destination');
            $table->date('date');
            $table->string('masterAirwayBill');
            $table->longText('remarks')->nullable();

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
        Schema::dropIfExists('manifests');
    }
}
