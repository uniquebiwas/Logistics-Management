<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('external_url')->nullable();
            $table->string('path')->nullable()->comment('image path after uploads');
            $table->string('slug')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('parallex_img')->nullable();
            $table->string('code')->nullable();
            $table->enum('publish_status', ['0', '1'])->default('1');
            $table->enum('postType', ['news', 'blog', 'talks', 'article'])->default('blog');
            $table->bigInteger('view_count')->default(0);
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyphrase')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
