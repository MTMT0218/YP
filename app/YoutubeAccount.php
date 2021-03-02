<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class YoutubeAccount extends Model
{

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User',"user_youtubeaccount","account_id","user_id");
    }

    public function youtubeVideos()
    {
      return $this->hasMany('App\YoutubeVideo',"playlist","playlist");
    }

    public function getYoutubeChannels($channel_id){
        return DB::table('youtube_accounts')
        ->where("account_id",$channel_id)
        ->first();
    }

}
