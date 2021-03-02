<?php

namespace App\Module;

class YoutubeApi{

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

    public function getJson($data,$url){
        //URL エンコードされたクエリ文字列を生成
        $query=http_build_query($data);

        //URL情報取得
        if($response = file_get_contents($url."?".$query)){

            //json文字列デコード
        $contents = json_decode($response, true);
        return $contents;
        }


    }    }
?>
