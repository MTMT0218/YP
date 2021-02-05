<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WatchedVideo extends Model
{
    protected $guarded = [];

    public function initialize($contents,$playlist){//初期にテーブル確保
        foreach($contents as $content){
            $this->firstOrCreate([
                "video_id"=>$content["snippet"]["resourceId"]["videoId"],
                ],
                ["playlist"=>$playlist,
                "user_id"=>Auth::id(),
                ]
            );
        };

    }
}
