<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraFieldsInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected function changeServiceRequest($table)
    {
        // if (!Schema::hasColumn('service_requests', 'startDate'))
        //     $table->timestamp('startDate')->nullable();
        // if (!Schema::hasColumn('service_requests', 'endDate'))
        //     $table->timestamp('endDate')->nullable();

    }




    protected function shipmentCharge()
    {
        Schema::table('shipment_charges', function (Blueprint $table) {
            if (!Schema::hasColumn('shipment_charges', 'agentId')) {
                $table->unsignedBigInteger('agentId')->nullable();
                $table->foreign('agentId')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            }
            if (!Schema::hasColumn('shipment_charges', 'tiaCharge')) {
                $table->float('tiaCharge', 8, 2)->nullable()->default(0);
            }

            if (!Schema::hasColumn('shipment_charges', 'tiaCalculatedCharge')) {
                $table->float('tiaCalculatedCharge', 8, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('shipment_charges', 'handling')) {
                $table->float('handling', 8, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('shipment_charges', 'handlingCalculated')) {
                $table->float('handlingCalculated', 8, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('shipment_charges', 'packaging')) {
                $table->float('packaging', 8, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('shipment_charges', 'billing')) {
                $table->float('billing', 8, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('shipment_charges', 'billingCalculated')) {
                $table->float('billingCalculated', 8, 2)->nullable()->default(0);
            }
        });
    }

    protected function shipmentItems()
    {
        Schema::table('shipment_items', function (Blueprint $table) {
            if (!Schema::hasColumn('shipment_items', 'isBagged')) {
                $table->boolean('isBagged')->default(false);
            }
        });
    }



    protected function nationalManifest()
    {
        Schema::table('national_manifests', function (Blueprint $table) {
            if (!Schema::hasColumn('national_manifests', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
        Schema::table('national_manifests', function (Blueprint $table) {
            if (!Schema::hasColumn('national_manifests', 'currencyType')) {
                $table->string('currencyType', 20)->nullable();
            }
        });
        Schema::table('house_of_ladings', function (Blueprint $table) {
            if (!Schema::hasColumn('house_of_ladings', 'amountInWords')) {
                $table->string('amountInWords', 450)->nullable();
            }
        });
    }

    protected function consumedOtp()
    {
        Schema::table('consumed_otps', function (Blueprint $table) {

            if (!Schema::hasColumn('consumed_otps', 'mobile')) {
                $table->unsignedBigInteger('mobile')->nullable();

                $table->string('token')->nullable();
            }
        });
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'documentVerifiedAt')) {
                $table->timestamp('documentVerifiedAt')->nullable();
            }
            if (!Schema::hasColumn('users', 'accountNumber')) {
                $table->string('accountNumber')->nullable();
            }
            if (!Schema::hasColumn('users', 'slug')) {
                $table->string('slug')->nullable();
            }
            if (!Schema::hasColumn('users', 'publish_status')) {
                $table->boolean('publish_status')->default(true);
            }
            if (!Schema::hasColumn('users', 'password_reset_at')) {
                $table->timestamp('password_reset_at')->nullable();
            }
        });
        Schema::table('service_agents', function (Blueprint $table) {

            if (!Schema::hasColumn('service_agents', 'api_url')) {
                $table->string('api_url')->nullable();
            }
        });
        Schema::table('shipment_packages', function (Blueprint $table) {

            if (!Schema::hasColumn('shipment_packages', 'statusId')) {
                $table->unsignedBigInteger('statusId')->default(1);
                $table->foreign('statusId')->on('status_levels')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            }
            if (!Schema::hasColumn('shipment_packages', 'invoice')) {
                $table->boolean('invoice')->default(false);
            }
            if (!Schema::hasColumn('shipment_packages', 'shipmentReference')) {
                $table->string('shipmentReference')->nullable();
            }
            if (!Schema::hasColumn('shipment_packages', 'mwab')) {
                $table->string('mwab')->nullable();
            }
            if (!Schema::hasColumn('shipment_packages', 'export_type')) {
                $table->string('export_type', 40)->nullable();
            }
            if (!Schema::hasColumn('shipment_packages', 'destination_duties')) {
                $table->string('destination_duties', 40)->nullable();
            }
            if (!Schema::hasColumn('shipment_packages', 'receiverCountryId')) {
                $table->unsignedBigInteger('receiverCountryId')->nullable();
                $table->foreign('receiverCountryId')->on('countries')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            }
            if (!Schema::hasColumn('shipment_packages', 'payment_terms')) {
                $table->enum('payment_terms', ['cash', 'credit'])->nullable();
            }

            if (!Schema::hasColumn('shipment_packages', 'billing_account')) {
                $table->string('billing_account', 40)->nullable();
            }
        });
        Schema::table('shipment_locations', function (Blueprint $table) {

            if (!Schema::hasColumn('shipment_locations', 'statusId')) {
                $table->unsignedBigInteger('statusId')->default(1);
                $table->foreign('statusId')->on('status_levels')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            }
            if (!Schema::hasColumn('shipment_locations', 'date')) {
                $table->dateTime('date')->nullable();
            }
            if (!Schema::hasColumn('shipment_locations', 'extra_status')) {
                $table->string('extra_status')->nullable();
            }
        });
        Schema::table('locations', function (Blueprint $table) {
            if (!Schema::hasColumn('locations', 'type')) {
                $table->string('type')->nullable()->default('LOCATION');
            }
        });
        Schema::table('agent_profiles', function (Blueprint $table) {

            if (!Schema::hasColumn('agent_profiles', 'company_phone')) {
                $table->string('company_phone')->nullable();
            }
            if (!Schema::hasColumn('agent_profiles', 'accountant_name')) {
                $table->string('accountant_name')->nullable();
            }
            if (!Schema::hasColumn('agent_profiles', 'accountant_email')) {
                $table->string('accountant_email')->nullable();
            }
            if (!Schema::hasColumn('agent_profiles', 'accountant_phone')) {
                $table->string('accountant_phone')->nullable();
            }
        });

        Schema::table('credits', function (Blueprint $table) {

            if (!Schema::hasColumn('credits', 'type')) {
                $table->enum('type', ['credit', 'advance'])->default('credit');
            }
        });
        Schema::table('contacts', function (Blueprint $table) {

            if (!Schema::hasColumn('contacts', 'view_status')) {
                $table->boolean('view_status')->default(false);
            }
        });
        Schema::table('app_settings', function (Blueprint $table) {

            if (!Schema::hasColumn('app_settings', 'pan')) {
                $table->string('pan')->nullable();
            }
        });
        Schema::table('app_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('app_settings', 'tiaCharge')) {
                $table->double('tiaCharge', 8, 2)->default(5.00);
            }
        });
    }

    private function pricings()
    {
        Schema::table('pricings', function (Blueprint $table) {
            if (!Schema::hasColumn('pricings', 'effectiveDate')) {
                $table->dateTime('effectiveDate')->nullable();
            }
        });
    }

    public function cargoInvoice()
    {
        Schema::table('cargo_invoice_awbs', function (Blueprint $table) {
            if (!Schema::hasColumn('cargo_invoice_awbs', 'consignee')) {
                $table->string('consignee')->nullable();
            }
        });
    }

    public function up()
    {

        $this->consumedOtp();
        $this->shipmentCharge();
        $this->shipmentItems();
        $this->nationalManifest();
        $this->pricings();
        $this->cargoInvoice();

        // Schema::table('service_requests', function (Blueprint $table) {
        //     $this->changeServiceRequest($table);
        // });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('extra_fields_in');
    }
}
