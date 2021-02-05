<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\WatchedVideo;
use Illuminate\Http\Request;
use App\file;
class GetWatchingInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(Request $request){
    //ビデオID
    $videoId=$request["video_id"];
    //視聴時間
    $watchedAt=$request["watched_at"];
    //視聴状況
    $watchedFlag=$request["watched_flag"];
    $watchedVideo=new WatchedVideo();
    $watchedVideo->where("user_id",Auth::id())
    ->where("video_id",$videoId)->update([
        "watched_at"=> gmdate("H:i:s",round($watchedAt)),
        "watched_flag"=>$watchedFlag,
    ]);
    return response()->json($request);
    }
}
