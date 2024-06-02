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
            $table->foreignId('channel_id')->constrained('youtubeupload_channel')->onDelete('cascade');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('videoId')->nullable()->unique();
            $table->string('url')->nullable();
            $table->string('urlimage')->nullable();
            $table->string('duration')->nullable()->default('0');
            $table->tinyInteger('is_published')->nullable(); // 0 = not published, 1 = published, 2 = private
            $table->tinyInteger('is_owner')->nullable(); // 0 = not owner, 1 = owner
            $table->tinyInteger('validation')->nullable(); //
            $table->integer('videocategory_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
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
