<?php

/*
|--------------------------------------------------------------------------
| 24 Seconds - Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*use App\PlayerTeam;
use Illuminate\Support\Facades\Input;*/

/*Route::get('/', function () {
    return view('index');
});*/
 
/*Route::get('/information/create/ajax-state', function()
{
    $team_id = Input::get('team_id');
    $subcategories = PlayerTeam::where('team_id', '=', $team_id)->get();
    return $subcategories;
 
});*/

/*Route::get('myform', 'AjaxDemoController@myform');
Route::post('select-ajax', ['as'=>'select-ajax','uses'=>'AjaxDemoController@selectAjax']);*/

// Route::get('/prodview', 'TestController@prodfunct');

Route::get('/', 'HomeController@index');

Route::get('/findPlayerName', 'HomeController@findPlayerName');

Route::get('/gamestats', 'GameStatController@index');

Route::get('/gamestats/{game}', 'GameStatController@show');

Route::get('/team/{team}', 'TeamController@show')->name('team');

Route::get('/player/{player}', 'PlayerController@show')->name('player');

Route::get('/submit', 'SubmitController@submit');

Route::get('/standings', 'StandingController@show');



// Route::get('/quarters/{game}', 'ScoreQuarterController@show');

Route::get('/teamstats', 'TeamStatController@create');




