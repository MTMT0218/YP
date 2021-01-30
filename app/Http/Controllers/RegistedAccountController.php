<?php

namespace App\Http\Controllers;


use App\YoutubeVideo;

use App\YoutubeAccount;
use Illuminate\Http\Request;
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
        $thumbnailsUrl="";
        //チャンネル動画
        $playlist="";
        //検索url
        $url=$request->input("url");

        //チャンネルID取得
        $channelId="";
        preg_match('/channel\/(.*)/', $url, $temp);
        $channelId=$temp[1];

        $contents=$this->getChannels($channelId);
        $resource=$contents['items'][0];
        $title=$resource['snippet']["title"];
        $thumbnailsUrl=$resource['snippet']["thumbnails"]["high"]["url"];
        $playlist=$resource["contentDetails"]["relatedPlaylists"]["uploads"];


        return view("registedaccount",compact('title','thumbnailsUrl','playlist','channelId'));
    }
    public function regist(Request $request){
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



        $contents=$this->getPlaylstItems($request->input("playlist"));

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
        return redirect("showaccountlist");
    }

    public function getChannels($channelId){//Channelsのデータ取得する
          //環境変数からAPI_KEY取得
          $DEVELOPER_KEY=getenv("YOUTUBE_API");
          //クエリパラメータ指定
          $data = array(
              'key' => $DEVELOPER_KEY,
              'part' => 'contentDetails,snippet',
              'id' => $channelId,
          );
          //チャンネルHTTPリクエスト
          $url="https://www.googleapis.com/youtube/v3/channels";

          return $this->getJson($data,$url);

    }

    public function getPlaylstItems($playList){//playlistItemsのデータ取得する

        //環境変数からAPI_KEY取得
        $DEVELOPER_KEY=getenv("YOUTUBE_API");

        //クエリパラメータ指定
          $data = array(
            'key' => $DEVELOPER_KEY,
            'part' => 'id,snippet',
            'playlistId'=>$playList,
            'fields'=>"items(snippet(publishedAt,title,thumbnails,resourceId(videoId)))"
        );
        //チャンネルHTTPリクエスト
        $url="https://www.googleapis.com/youtube/v3/playlistItems";

        return $this->getJson($data,$url)["items"];
    }

    public function getJson($data,$url){
        //URL エンコードされたクエリ文字列を生成
        $query=http_build_query($data);
        //URL情報取得
        $response = file_get_contents($url."?".$query);
        //json文字列デコード
        $contents = json_decode($response, true);
        return $contents;
    }

}
