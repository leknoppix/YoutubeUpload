<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the 'youtubeupload_videos' table in the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtubeupload_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('access_token_id');
            $table->foreign('access_token_id')->references('id')->on('youtubeupload_access_tokens');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('videoId')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('is_published')->nullable();
            $table->tinyInteger('is_owner')->nullable();
            $table->integer('videocategory_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('validation_id')->nullable();
            $table->foreign('validation_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youtubeupload_videos');
    }
};
