<?php

namespace App\Http\Controllers;

use App\WatchedVideo;
use App\YoutubeVideo;
use App\YoutubeAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Module\YoutubeApi;

class RegistedAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

    return view("registedaccount");
    }

    public function serch(Request $request){
        $youtubeApi=new YoutubeApi();
        //タイトル
        $title="";
        //サムネイル画像URL
        $thumbnailsUrl="";
        //チャンネル動画
        $playlist="";
        //検索url
        $url=$request->input("url");

        //チャンネルID取得
        $channelId="";
        preg_match('/channel\/(.*)/', $url, $temp);
        $channelId=$temp[1];

        $contents=$youtubeApi->getChannels($channelId);
        $resource=$contents['items'][0];
        $title=$resource['snippet']["title"];
        $thumbnailsUrl=$resource['snippet']["thumbnails"]["high"]["url"];
        $playlist=$resource["contentDetails"]["relatedPlaylists"]["uploads"];
        return view("registedaccount",compact('title','thumbnailsUrl','playlist','channelId'));
    }
    public function regist(Request $request){
        $youtubeApi=new YoutubeApi();
        //チャンネル保存
        $youtubeAccount=new YoutubeAccount();
        $youtubeAccount->firstOrCreate(
            ["account_id"=>$request->input("accountId")
            ],
            ["title"=>$request->input("title"),
            "thumbnails_url"=>$request->input("thumbnailsUrl"),
            "playlist"=>$request->input("playlist"),
            "user_id"=>Auth::id()
            ]
        );



        $contents=$youtubeApi->getPlaylstItems($request->input("playlist"));
        //チャンネル動画保存
        foreach($contents as $content){
            $youtbeVideo=new YoutubeVideo();
            $youtbeVideo->firstOrCreate([
                "video_id"=>$content["snippet"]["resourceId"]["videoId"],
                ],
                ["thumbnails_url"=>$content["snippet"]["thumbnails"]["high"]["url"],
                "title"=>$content["snippet"]["title"],
                "published_at"=>$content["snippet"]["publishedAt"],
                "playlist"=>$request->input("playlist"),
                ]
            );
        }
        //チャンネル視聴記録テーブル確保
        foreach($contents as $content){
            $watchedVideo=new WatchedVideo();
            $watchedVideo->firstOrCreate([
                "video_id"=>$content["snippet"]["resourceId"]["videoId"],
                ],
                ["playlist"=>$request->input("playlist"),
                "user_id"=>Auth::id(),
                ]
            );
        };
        return redirect("showaccountlist");
    }



}
