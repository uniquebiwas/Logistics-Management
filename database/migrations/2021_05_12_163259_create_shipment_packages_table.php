<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentPackagesTable extends Migration
{
    public function up()
    {
        Schema::create('shipment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('content')->nullable();
            $table->dateTime('shipment_date');
            $table->string('receiverAttention')->nullable();
            $table->string('package_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('value')->nullable();
            $table->string('currency_type')->nullable();
            $table->unsignedBigInteger('shipment_type')->nullable();
            $table->string('export_type', 40)->nullable();
            $table->string('barcode')->nullable()->unique();
            $table->text('remarks')->nullable();
            $table->string('total_weight')->nullable();
            $table->string('total_volume_weight')->nullable();
            $table->string('total_chargeable_weight')->nullable();
            $table->enum('package_status', ['PENDING', 'CANCELLED', 'RECEIVED', 'MANIFESTED', 'SCHEDULED', 'DISPATCHED', 'IN TRANSIT', 'ARRIVED AT DUBAI', 'TRACKING CODE UPDATED', 'DELIVERED'])->default('PENDING')->index();
            $table->unsignedBigInteger('agentId')->nullable();
            $table->unsignedBigInteger('service_agent')->nullable();


            // Sender Detail
            $table->unsignedBigInteger('senderId')->nullable();
            $table->unsignedBigInteger('receiverId')->nullable();

            // Shipment Payment Information
            $table->enum('payment_type', ['Prepaid', 'Postpaid'])->default('Prepaid');
            $table->enum('payment_method', ['Online', 'Offline'])->default('Offline');




            // Shipment Cancellation
            $table->unsignedBigInteger('cancellation_reason')->nullable();
            $table->text('cancellation_remarks')->nullable();
            $table->enum('cancelled_by_type', ['ADMIN', 'AGENT'])->default('AGENT');
            $table->string('cancelled_at')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();

            // Shipment Approval
            $table->string('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();

            // Shipment Received
            $table->string('received_at')->nullable();
            $table->unsignedBigInteger('received_by')->nullable();

            // Shipment Scheduled
            $table->string('scheduled_at')->nullable();
            $table->string('scheduled_for')->nullable();
            $table->unsignedBigInteger('scheduled_by')->nullable();

            // Shipment Dispatched
            $table->string('dispatched_at')->nullable();
            $table->unsignedBigInteger('dispatched_by')->nullable();
            $table->string('flightNumber')->nullable();
            $table->string('airlines')->nullable();


            // Shipment AWB
            $table->string('awb_number')->nullable();
            $table->string('tracking_code')->nullable();
            $table->boolean('accept_terms')->default(false);
            $table->boolean('manifest')->default(false);
            $table->boolean('nationalManifest')->default(false);
            $table->boolean('export')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('senderId')->references('id')->on('customers')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('receiverId')->references('id')->on('customers')->onDelete('SET NULL')->onUpdate('CASCADE');

            $table->foreign('shipment_type')->references('id')->on('shipment_package_types')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('agentId')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('service_agent')->references('id')->on('service_agents')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('cancellation_reason')->references('id')->on('shipment_cancellation_reasons')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('received_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('dispatched_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('scheduled_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_packages');
    }
}
