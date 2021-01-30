<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class YoutubeAccount extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function youtubeVideos()
    {
      return $this->hasMany('App\YoutubeVideo',"playlist","playlist");
    }

    public function getYoutubeAccounts($user_id){
        return DB::table('youtube_accounts')
        ->where("user_id",$user_id)
        ->get();
    }

}
