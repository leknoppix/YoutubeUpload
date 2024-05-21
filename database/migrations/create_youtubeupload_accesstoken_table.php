<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the 'youtubeupload_access_token' table in the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtubeupload_access_token', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->string('channel_id');
            $table->string('access_token');
            $table->enum('is_favorite', ['yes', 'no'])->default('non');
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
        Schema::dropIfExists('youtubeupload_access_token');
    }
};
