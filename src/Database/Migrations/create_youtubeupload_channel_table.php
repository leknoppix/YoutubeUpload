<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the 'youtubeupload_access_tokens' table in the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtubeupload_channel', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->string('channel_YT_id');
            $table->enum('is_favorite', ['yes', 'no'])->default('no');
            $table->enum('get_video_list', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('youtubeupload_channel');
    }
};
