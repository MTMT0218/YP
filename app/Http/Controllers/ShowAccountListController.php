<?php

namespace App\Http\Controllers;

use App\YoutubeAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ShowAccountListController extends Controller
{
    public function index(){
        $youtubeAccount=new YoutubeAccount;
        $user=new User();
        $user_id=Auth::id();

        $userData=$user ->with(['youtubeAccounts.youtubeVideos.watchedVideos'=> function ($query) {
            $query->where('user_id',Auth::id());
        }])->where('id',$user_id)->first()->toArray();
        var_dump($userData);
        return view("showaccountlist",$userData);

    }
}
