<?php

namespace App\Http\Controllers;
use App\WatchedVideo;
use App\User;
use App\YoutubeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\module\YoutubeApi;

class UpdateChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user=new User();
        $user_id=Auth::id();
        $youtubeApi=new YoutubeApi();
        //ユーザの登録チャンネル確保
        $userData=$user ->with(['youtubeAccounts'])->where('id',$user_id)->first()->toArray();
        foreach($userData["youtube_accounts"] as $youtubeAccounts){
        $contents=$youtubeApi->getPlaylstItems($youtubeAccounts["playlist"]);
        $lencontents=count($contents)-1;
        //チャンネル動画保存
        foreach($contents as $index =>$content){
            $youtbeVideo=new YoutubeVideo();
            $youtbeVideo->firstOrCreate([
                "video_id"=>$content["snippet"]["resourceId"]["videoId"],
                ],
                ["thumbnails_url"=>$content["snippet"]["thumbnails"]["high"]["url"],
                "title"=>$content["snippet"]["title"],
                "published_at"=>$content["snippet"]["publishedAt"],
                "playlist"=>$youtubeAccounts["playlist"],
                ]
            );
        }
            $watchedVideo=new WatchedVideo();
            $watchedVideo->firstOrCreate([
                "video_id"=>$content["snippet"]["resourceId"]["videoId"],
                ],
                ["playlist"=>$youtubeAccounts["playlist"],
                "user_id"=>Auth::id(),
                ]
            );
        if($index==$lencontents){
            $oldVideo=$youtbeVideo->with('watchedVideos')->where("published_at",">",$content["snippet"]["publishedAt"]);
            $temp=$oldVideo->get("video_id")->toArray();
            var_dump($temp);exit();
        }

    }
    return redirect("showaccountlist");
}



}
