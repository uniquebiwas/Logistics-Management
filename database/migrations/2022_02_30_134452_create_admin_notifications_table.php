<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('senderId')->nullable()->comment('user Id id of users table ');
            $table->unsignedBigInteger('recieverId')->nullable()->comment('admin  id of admins table ');
            $table->timestamp('seen_at')->nullable();
            $table->string('firebaseMessageId')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('senderId')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('recieverId')->references('id')->on('admins')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_notifications');
    }
}
