<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('youtubeupload_access_token', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->string('channel_id');
            $table->string('access_token');
            $table->timestamps();
        });
    }
};
