<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->text('phone')->nullable();
            $table->string('is_favicon')->nullable();
            $table->string('app_url')->nullable();
            $table->string('app_image')->nullable();
            $table->enum('website_content_format', ['English', 'Nepali', 'Other', 'Both'])->default('English');
            $table->text('website_content_item')->nullable();
            $table->string('twitter')->nullable();
            $table->double('min_agent_balance')->nullable();
            $table->string('footer_description')->nullable();
            $table->string('front_counter_description')->nullable();
            $table->string('front_testimonial_description')->nullable();
            $table->string('banner_news')->nullable();
            $table->enum('is_startup_ad', ['0', '1'])->nullable();
            $table->string('startup_ad_number')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();

            $table->string('is_meta')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyphrase')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('og_image')->nullable();

            $table->string('logo_url')->nullable();

            $table->string('dhl_api_key')->nullable();
            $table->string('fedex_api_key')->nullable();
            $table->string('term_con_link')->nullable();


            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
    }
}
