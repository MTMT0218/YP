<?php

namespace App\Http\Controllers;

use App\YoutubeAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Module\YoutubeChannel;

class ShowAccountListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        YoutubeChannel::update();
        $youtubeAccount=new YoutubeAccount;
        $user=new User();
        $user_id=Auth::id();
        //チャンネルごとの未視聴の動画数確保
        $userData= $user::where("id",Auth::id())->with(['youtubeAccounts.youtubeVideos.watchedVideos'=> function ($query) {
                $query->where('user_id',Auth::id());
            }])->first()->toArray();

        //ユーザの登録チャンネル及びアップロード動画確保
        $nonWatched=0;
        foreach($userData["youtube_accounts"] as $index => $account){
            foreach($account["youtube_videos"] as $video){
                if(!isset($video["watched_videos"]["watched_flag"])){
                    break;
                }
                if($video["watched_videos"]["watched_flag"]==0){
                    $nonWatched++;
                }
            }
            $userData["youtube_accounts"][$index]["non_watched"]=$nonWatched;

            $nonWatched=0;

        }
        return view("showaccountlist",$userData);

    }

    public function update(){


    }
}
