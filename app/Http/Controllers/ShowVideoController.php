<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowVideoController extends Controller
{
   public function index(Request $request){
    var_dump($request->all());
    return view("showvideo");
   }
}
