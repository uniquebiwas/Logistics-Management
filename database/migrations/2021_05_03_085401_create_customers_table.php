<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customerId')->unique();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('fax')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
