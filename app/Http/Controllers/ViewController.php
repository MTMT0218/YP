<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{




    public function index(Request $request)
    {
        $url=$request->url;
        preg_match('/youtu.be\/(.*)/', $url, $VideoId);
        return view('view', ['VideoId' => $VideoId[1]]);
    }
}


