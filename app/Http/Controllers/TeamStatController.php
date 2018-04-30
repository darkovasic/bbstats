<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TeamStatController extends Controller
{
    public function create() {

    	$countGames = \App\GameStat::select('game_id')->distinct()->get()->count();

		for ($i=1; $i <= $countGames; $i++) {	

			$home = [];
			$away = [];
			$teamStats = [];			

			$gameStats = \App\GameStat::where('game_id', $i)->get();	
			$game = \App\Game::select('id', 'home_team_id', 'away_team_id')->where('id', $i)->first();

			foreach ($gameStats as $row) {
				
				if ($row->team_id == $game->homeTeam->id) {
					$home[] = $row;
				} else {
					$away[] = $row;
				}

			}

			$teamStats[] = $this->calcTeamStats($home);
			$teamStats[] = $this->calcTeamStats($away);

			try {
				\App\TeamStat::insert($teamStats);
			} catch (QueryException $e) {
				echo 'Caught exception: '.$e->getMessage()."<br><br>";			
    		}		
		}
    }

    public function calcTeamStats($team) {

    	$teamStats = [
    		"game_id" => $team[0]->game_id,
    		"team_id" => $team[0]->team_id,
			"on_court" => "200:00",
			"points" => 0,   		
		    "percentage" => 0,
		    "fg2_in" => 0,
		    "fg2_attempts" => 0,
		    "fg2_percentage" => 0,
		    "fg3_in" => 0,
		    "fg3_attempts" => 0,
		    "fg3_percentage" => 0,
		    "ft_in" => 0,
		    "ft_attempts" => 0,
		    "ft_percentage" => 0,
		    "rebound_defensive" => 0,
		    "rebound_offensive" => 0,
		    "assist" => 0,
		    "steal" => 0,
		    "turnover" => 0,
		    "block_fw" => 0,
		    "block_ag" => 0,
		    "foul_cm" => 0,
		    "foul_rv" => 0,
		    "value" => 0,    		
    	];


    	foreach ($team as $row) {
    		
    		$teamStats['points'] += $row->points;
    		$teamStats['fg2_in'] += $row->fg2_in;
    		$teamStats['fg2_attempts'] += $row->fg2_attempts;
    		$teamStats['fg3_in'] += $row->fg3_in;
    		$teamStats['fg3_attempts'] += $row->fg3_attempts;
    		$teamStats['ft_in'] += $row->ft_in;
    		$teamStats['ft_attempts'] += $row->ft_attempts;
    		$teamStats['rebound_defensive'] += $row->rebound_defensive;
    		$teamStats['rebound_offensive'] += $row->rebound_offensive;
    		$teamStats['assist'] += $row->assist;
    		$teamStats['steal'] += $row->steal;
    		$teamStats['turnover'] += $row->turnover;
    		$teamStats['block_fw'] += $row->block_fw;
    		$teamStats['block_ag'] += $row->block_ag;
    		$teamStats['foul_cm'] += $row->foul_cm;
    		$teamStats['foul_rv'] += $row->foul_rv;
    		$teamStats['value'] += $row->value;

    	}

		if ($teamStats['fg2_attempts'] > 0) $teamStats['fg2_percentage'] = round(($teamStats['fg2_in'] * 100 / $teamStats['fg2_attempts']), 1);
		if ($teamStats['fg3_attempts'] > 0) $teamStats['fg3_percentage'] = round(($teamStats['fg3_in'] * 100 / $teamStats['fg3_attempts']), 1);
		if ($teamStats['fg2_attempts'] + $teamStats['fg3_attempts'] > 0) $teamStats['percentage'] = round((($teamStats['fg2_in'] + $teamStats['fg3_in']) * 100 / ($teamStats['fg2_attempts'] + $teamStats['fg3_attempts'])), 1);
		if ($teamStats['ft_attempts'] > 0) $teamStats['ft_percentage'] = round(($teamStats['ft_in'] * 100 / $teamStats['ft_attempts']), 1);    	

    	return $teamStats;
    }

}
