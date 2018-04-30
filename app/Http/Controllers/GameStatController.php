<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\GameStat;
use App\TeamStat;
use App\Game;
use App\PlayByPlay;
use Carbon\Carbon;

class GameStatController extends Controller
{


    public function index() {

    	return view('gamestats.index');
    }

    public function show($game_id) {


    	$game = Game::find($game_id);
    	$game->start_date_time = Carbon::parse($game->start_date_time)->toDayDateTimeString();
    	// dd($game->awayTeam);

    	$stats = GameStat::getStats($game_id)->get();
    	$stats = json_decode(json_encode($stats), true);

    	foreach ($stats as &$row) {	

    		$player = Player::find($row['player_id']);

    		unset($row['id'], $row['game_id']);
    		$row['on_court'] = substr($row['on_court'], 3);
    		$row['player_id'] = "$player->first_name $player->last_name";

    		if ($row['team_id'] == $game->home_team_id) {
    			unset($row['team_id']);
    			$homeTeamStats[] = $row;
    			$homeTeamPlayers[] = $player->id;
    		} else {
    			unset($row['team_id']);
    			$awayTeamStats[] = $row;
    			$awayTeamPlayers[] = $player->id;
    		}
    	}


    	$scorePeriod = $this->scoreByPeriods($game_id);
    	array_unshift($scorePeriod[0], "");
    	array_unshift($scorePeriod[1], $game->homeTeam->name);
    	array_unshift($scorePeriod[2], $game->awayTeam->name);

    	
    	$teamStats = TeamStat::where(['game_id' => $game_id])->get();
    	$table = json_decode(json_encode($teamStats), true);

    	$i=0;
    	foreach ($table as $row) {

		    array_splice($row, 0, 2);
			$row = ["player_id" => "Total"] + $row + ["plus_minus" => "N/A"];

    		if ($teamStats[$i]->team_id == $game->homeTeam->id) {
    			$homeTeamStats[] = $row;
    		} else {
    			$awayTeamStats[] = $row;
    		}

    		$i++;
    	}


    	return view('gamestats.show', compact('homeTeamStats', 'awayTeamStats', 'homeTeamPlayers', 'awayTeamPlayers', 'game', 'scorePeriod'));
    }

	/**
     * 
     *
     * @param int $game_id
     * @return array $scorePeriod
     */

    public function scoreByPeriods($game_id) {

		$periodEnd = [4,6,8,10,14,16,18];
		$th = ['Q1', 'Q2', 'Q3', 'Q4', 'OT1', 'OT2', 'OT3', 'OT4', 'OT5'];

		$count = count($periodEnd);
		for ($i=0; $i < $count; $i++) { 
			try {
				$periodEndId[] = PlayByPlay::where(['special_event_id' => $periodEnd[$i], 'game_id' => $game_id])->first()->id;
				$scoreRow[] = PlayByPlay::where('id', '>', $periodEndId[$i])->whereNotNull('score_home')->first();
			} catch (\Exception $e) {}

			if (!isset($periodEndId[$i])) break;
		}

		$count = count($scoreRow);
		for ($i=0; $i < $count; $i++) { 
			$scorePeriod[0][] = $th[$i];
			if ($i == 0) {
				$scorePeriod[1][] = $scoreRow[$i]->score_home;
				$scorePeriod[2][] = $scoreRow[$i]->score_away;				
			} else {	
				$scorePeriod[1][] = $scoreRow[$i]->score_home - $scoreRow[$i-1]->score_home;
				$scorePeriod[2][] = $scoreRow[$i]->score_away - $scoreRow[$i-1]->score_away;
			}
		}

		return $scorePeriod;

    }    
}
