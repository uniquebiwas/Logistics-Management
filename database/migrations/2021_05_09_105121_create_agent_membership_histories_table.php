<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentMembershipHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_membership_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agentId')->index()->nullable();
            $table->unsignedBigInteger('membershipPackageId')->index()->nullable();
            $table->string('totalAmount')->nullable();
            $table->string('totalRequest')->nullable();
            $table->string('usedRequest')->nullable();
            $table->string('cancelledRequest')->nullable();
            $table->string('remainingRequestCount')->nullable();
            $table->enum('isExpired', ['YES', 'NO'])->default('NO');
            $table->foreign('agentId')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('membershipPackageId')->references('id')->on('membership_packages')->onDelete('SET NULL')->onUpdate('CASCADE');
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
        Schema::dropIfExists('agent_membership_histories');
    }
}
