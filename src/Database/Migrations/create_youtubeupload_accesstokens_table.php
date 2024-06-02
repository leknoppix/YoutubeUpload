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
        Schema::create('youtubeupload_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained('youtubeupload_channel')->onDelete('cascade');
            $table->string('access_token');
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
