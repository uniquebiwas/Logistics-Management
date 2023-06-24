<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->text('full_name')->nullable();
            $table->string('image')->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('description')->nullable();
        

            $table->enum('publish_status', ['0', '1'])->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('created_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('designation_id')->nullable()->constrained('designations')->onUpdate('cascade')->onDelete('cascade');;
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
