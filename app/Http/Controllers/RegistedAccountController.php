<?php

namespace App\Http\Controllers;

use App\YoutubeAccount;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Auth;


class RegistedAccountController extends Controller
{
    public function index(){

    return view("registedaccount");
    }

    public function serch(Request $request){
        //タイトル
        $title="";
        //サムネイル画像URL
        $thumbnailsURL="";
        //チャンネル動画
        $playList="";

        //検索ワード
        $url=$request->input("url");

        //アカウントID取得
        $accountID="";
        preg_match('/channel\/(.*)/', $url, $temp);
        $accountID=$temp[1];

        //環境変数からAPI_KEY取得
        $DEVELOPER_KEY=getenv("YOUTUBE_API");
        //クエリパラメータ指定
        $data = array(
            'key' => $DEVELOPER_KEY,
            'part' => 'contentDetails,snippet',
            'id' => $accountID,
        );
        //チャンネルHTTPリクエスト
        $url="https://www.googleapis.com/youtube/v3/channels";
        //URL エンコードされたクエリ文字列を生成
        $query=http_build_query($data);
        //URL情報取得
        $response = file_get_contents($url."?".$query);
        //json文字列デコード
        $contents = json_decode($response, true);


        $resource=$contents['items'][0];
        $title=$resource['snippet']["title"];
        $thumbnailsURL=$resource['snippet']["thumbnails"]["high"]["url"];
        $playList=$resource["contentDetails"]["relatedPlaylists"]["uploads"];


        return view("registedaccount",compact('title','thumbnailsURL','playList','accountID'));
    }
    public function regist(Request $request){
        $yotubeAccount=new YoutubeAccount();
        $yotubeAccount->title=$request->input("title");
        $yotubeAccount->thumbnails_URL=$request->input("thumbnailsURL");
        $yotubeAccount->playList=$request->input("playList");
        $yotubeAccount->account_id=$request->input("accountID");
        $yotubeAccount->user_id= Auth::id();
        $yotubeAccount->save();
        return view("home");
    }
}
