<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agentId')->nullable();
            $table->unsignedBigInteger('verifiedBy')->nullable();
            $table->string('documentType')->nullable();
            $table->text('comments')->nullable();
            $table->date('verifiedAt')->nullable();
            $table->string('documentNo')->nullable();
            $table->string('documentPath')->nullable();
            $table->enum('status',['verified','unverified','requested'])->default('unverified');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('agentId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verifiedBy')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_documents');
    }
}
