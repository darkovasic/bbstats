<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index() {
    	
    	return view('homepage.show');

    }

    public function findPlayerName(Request $request) {

    	$data = DB::table('player_team')->join('players', 'player_team.player_id', '=', 'players.id')->where('team_id', $request->id)->get();
    	return $data;

    }
}
