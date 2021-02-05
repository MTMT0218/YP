<?php

namespace App\Http\Controllers;
use App\WatchedVideo;
use App\User;
use App\YoutubeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user=new User();
        $user_id=Auth::id();
        //ユーザの登録チャンネル確保
        $userData=$user ->with(['youtubeAccounts'])->where('id',$user_id)->first()->toArray();

        foreach($userData["youtube_accounts"] as $youtubeAccounts){

        $contents=$this->getPlaylstItems($youtubeAccounts["playlist"]);
        //チャンネル動画保存
        foreach($contents as $content){
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
        foreach($contents as $content){
            $watchedVideo=new WatchedVideo();
            $watchedVideo->firstOrCreate([
                "video_id"=>$content["snippet"]["resourceId"]["videoId"],
                ],
                ["playlist"=>$youtubeAccounts["playlist"],
                "user_id"=>Auth::id(),
                ]
            );
        };

    }
    return redirect("showaccountlist");
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
