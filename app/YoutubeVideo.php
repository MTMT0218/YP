<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class YoutubeVideo extends Model
{
    protected $guarded = [];

    public function watchedVideos()
    {
      return $this->hasOne('App\WatchedVideo',"video_id","video_id");
    }

    public function regist($contents,$playlist){
        foreach($contents as $content){

             $this->firstOrCreate([
                "video_id"=>$content["snippet"]["resourceId"]["videoId"],
                ],
                ["thumbnails_url"=>$content["snippet"]["thumbnails"]["high"]["url"],
                "title"=>$content["snippet"]["title"],
                "published_at"=>$content["snippet"]["publishedAt"],
                "playlist"=>$playlist,
                ]
            );
        }
    }

    public function deleteOldVideo($contents,$playlist)//古い動画を視聴データと共に削除
    {
        $datetime=$contents[array_key_last($contents)]["snippet"]["publishedAt"];//一番古い動画の投稿時間

        $oldVideo=$this->where("playlist",$playlist)->where("published_at","<",$datetime);
        $temp=$oldVideo->get("video_id")->toArray();
        foreach($temp as $t){
           DB::table('watched_videos')->where("video_id",$t["video_id"])->delete();
        }
        $oldVideo->delete();

    }

}
