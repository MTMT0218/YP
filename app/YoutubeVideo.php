<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    protected $guarded = [];

    public function watchedVideos()
    {
      return $this->hasOne('App\WatchedVideo',"video_id","video_id");
    }

}
