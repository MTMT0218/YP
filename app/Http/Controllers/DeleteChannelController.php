<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\YoutubeAccount;
class DeleteChannelController extends Controller
{
    public function index(Request $request){
    $channelIds=$request->all()["id"];//削除するチャンネルのID
    $user = User::find(Auth::id());//ログインしているuserテーブル
    $youtubeChannnel=new YoutubeAccount();
    foreach($channelIds as $channelId){
    $channel=$youtubeChannnel->getYoutubeChannels($channelId);
    $user-> youtubeAccounts()->detach($channel->id);//関連テーブルを削除
    }
    return redirect("showaccountlist");
    }
}
