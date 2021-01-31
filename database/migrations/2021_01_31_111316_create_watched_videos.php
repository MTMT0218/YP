<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchedVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watched_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('playlist')->references('playlist')->on('youtube_accounts');
            $table->string("video_id")->references("video_id")->on("youtube_videos");
            $table->bigInteger('user_id')->references('id')->on('users');
            $table->time("wached_at")->default("00:00:00");
            $table->integer("wached_flag")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watched_videos');
    }
}
