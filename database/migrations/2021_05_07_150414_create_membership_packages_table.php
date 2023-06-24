<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('image_url')->nullable();
            $table->double('package_amount')->nullable();
            $table->integer('yearly_max_request')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('addedBy')->nullable();
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->boolean('publishStatus')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('addedBy')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
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
        Schema::dropIfExists('membership_packages');
    }
}
