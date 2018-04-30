<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PlayerTeamController extends Controller
{
    /**
     * Populate `player_team` pivot table using data from `pbp` table
     *
     * @param
     * @return
     */  

    public static function store() {

    	$pbp = DB::table('pbp')->where('game_id', '>', '66')->get();

    	foreach ($pbp as $row) {
    		if (isset($row->player_id)) {
    			try {
    				
		    		/*DB::table('player_team')->insert([
		    			'player_id' => $row->player_id,
		    			'team_id' => $row->team_id
		    		]);*/

		    		/*$player = Player::find($row->player_id);
    				$player->teams()->attach($row->team_id);*/

    				\App\PlayerTeam::create([
		    			'player_id' => $row->player_id,
		    			'team_id' => $row->team_id    					
    				]);
	    		} catch (QueryException $e) {
					echo 'Caught exception: '.$e->getMessage()."\n";			
	    		}
    		}
    	}

    }	
}
