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


      //  $temp=$youtubeAccount-> getYoutubeAccounts(Auth::user()->id);
        $userData=$user ->with('youtubeAccounts')
        ->where('id','1')->first()->toArray();
        return view("showaccountlist",$userData);

    }
}
