<?php

namespace App\Module;
use App\WatchedVideo;
use App\User;
use App\YoutubeVideo;
use Illuminate\Support\Facades\Auth;
use App\module\YoutubeApi;

class YoutubeChannel
{

    public  static function update(){
        $user=new User();
        $user_id=Auth::id();
        $youtubeApi=new YoutubeApi();
        //DBからユーザの登録チャンネルを取得
        $userData=$user ->with(['youtubeAccounts'])->where('id',$user_id)->first()->toArray();

        foreach($userData["youtube_accounts"] as $youtubeAccounts){
            $playlist=$youtubeAccounts["playlist"];
            //youtubeAPIから登録チャンネルのアップロード動画取得
            $contents=$youtubeApi->getPlaylstItems($playlist);
            $lencontents=count($contents)-1;
            //チャンネルのアップロード動画をDB保存
            $youtbeVideo=new YoutubeVideo();
            $youtbeVideo->regist($contents,$playlist);
            //チャンネル視聴データをDBに確保
            $watchedVideo=new WatchedVideo();
            $watchedVideo->initialize($contents,$playlist);
            //チャンネルの古い動画をDBから削除する
            $oldVideo=$youtbeVideo->deleteOldVideo($contents,$playlist);
    }





}



}
