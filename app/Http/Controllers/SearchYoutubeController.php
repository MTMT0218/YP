<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;

class SearchYoutubeController extends Controller{
 public function index()
    {
        return view("searchyoutube");
    }

 public function serch(Request $request){
    $keyword=$request->input("keyword");
    $DEVELOPER_KEY=getenv("YOUTUBE_API");
    $client = new Google_Client();
    $client->setDeveloperKey($DEVELOPER_KEY);
    $youtube = new Google_Service_YouTube($client);
    $title=array();
    $id=array();
    $thumbnails=array();
    $sizeChannel='12';
    try{
        $searchResponse =
        $youtube->search->listSearch('id,snippet', array(
          'q' => $keyword,
          'type'=>'channel',
          'maxResults'=>$sizeChannel,
        ));
        }catch(Exception $e){
          print("エラーが起きました\n");
        }
       foreach ($searchResponse['items'] as $searchResult) {
                array_push($title,$searchResult['snippet']['title']);
                array_push($id,$searchResult['id']['channelId']);
                array_push($thumbnails,$searchResult['snippet']['thumbnails']['high']['url']);
      }
      return view('searchyoutube',compact('title','id','thumbnails','sizeChannel'));
    }
}
