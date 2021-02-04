<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\ViewController;
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/view',"ViewController@index")->name("view");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

Route::get('/searchyoutube', 'SearchYoutubeController@index')->name("searchYoutube");

Route::get('/searchyoutube/search', 'SearchYoutubeController@serch')->name("searchYoutube/search");

Route::get('/registedaccount', 'RegistedAccountController@index')->name("registedAccount");

Route::get('/registedaccount/search', 'RegistedAccountController@serch')->name("registedAccount/search");

Route::post('/registedaccount/regist', 'RegistedAccountController@regist')->name("registedAccount/regist");


Route::get('/showaccountlist','ShowAccountListController@index')->name("showaccountlist");

Route::post("/showvideo","ShowVideoController@index")->name("showvideo");

Route::post("/getwatchinginformation","GetWatchingInformationController@index")->name("getwatchinginformation");

