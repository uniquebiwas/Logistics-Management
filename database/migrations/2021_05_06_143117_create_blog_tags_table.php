<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTagsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_tags');
    }
}
