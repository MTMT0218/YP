<?php

namespace App\Http\Controllers;

use App\WatchedVideo;
use App\YoutubeVideo;
use App\YoutubeAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Module\YoutubeApi;
use App\User;


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
        $playlist=$request->input("playlist");
        //チャンネル保存
        $user =new User();
        $youtubeAccounts=new YoutubeAccount();
        // チャンネルがDBに無ければ保存
        $youtubeAccounts->firstOrCreate(
            ["account_id"=>$request->input("accountId"),
            "title"=>$request->input("title"),
            "thumbnails_url"=>$request->input("thumbnailsUrl"),
            "playlist"=>$playlist,
            ]
        );
        //チャンネルのIDよりUserと紐づけ
        $youtubeAccountsId=$youtubeAccounts->where("account_id",$request->input("accountId"))->value('id');
        $user->find(Auth::id())->youtubeAccounts()->attach($youtubeAccountsId);

        //APIからチャンネルのプレイリストアイテム取得
        $contents=$youtubeApi->getPlaylstItems($playlist);
        //チャンネル動画保存
        $youtbeVideo=new YoutubeVideo();
        $youtbeVideo->regist($contents,$playlist);
         //チャンネル視聴記録テーブル確保
        $watchedVideo=new WatchedVideo();
        $watchedVideo->initialize($contents,$playlist);
        return redirect("showaccountlist");
    }



}
