<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('featured_img')->nullable();
            $table->unsignedBigInteger('created_by')->nullable(); 
            $table->enum('publish_status', ['0', '1'])->default(1);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
