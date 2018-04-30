<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\TeamStat;
use Carbon\Carbon;

class TeamController extends Controller
{
    public function show(Team $team) {

    	$stats = TeamStat::where('team_id', $team->id)->get();
    	$table = json_decode(json_encode($stats), true);

    	$i=0;
    	foreach ($table as &$row) {

    		unset($row['on_court'], $row['team_id']);
    		$gameName[] = $stats[$i]->game->homeTeam->short_name.' - '.$stats[$i]->game->awayTeam->short_name;
    		$date = Carbon::parse($stats[$i]->game->start_date_time)->toFormattedDateString();
    		$gameId[] = $stats[$i]->game->id;
    		array_splice($row, 1, 0, $date);

    		$i++;
    	}   

    	// dd($table);
    	$gameId = array_reverse($gameId);
    	$gameName = array_reverse($gameName);
    	$table = array_reverse($table);
    	$table = array_merge($table, $this->getTableSumAvg($table));

    	return view('team.show', compact('team', 'table', 'gameName', 'gameId'));
    }

    public function getTableSumAvg($table) {

    	$numRows = count($table);

    	$sum['points'] = array_sum(array_column($table, 'points'));
    	$sum['percentage'] = array_sum(array_column($table, 'percentage'));
    	$sum['fg2_in'] = array_sum(array_column($table, 'fg2_in'));
    	$sum['fg2_attempts'] = array_sum(array_column($table, 'fg2_attempts'));
    	$sum['fg2_percentage'] = array_sum(array_column($table, 'fg2_percentage'));
    	$sum['fg3_in'] = array_sum(array_column($table, 'fg3_in'));
    	$sum['fg3_attempts'] = array_sum(array_column($table, 'fg3_attempts'));
    	$sum['fg3_percentage'] = array_sum(array_column($table, 'fg3_percentage'));
    	$sum['ft_in'] = array_sum(array_column($table, 'ft_in'));
    	$sum['ft_attempts'] = array_sum(array_column($table, 'ft_attempts'));
    	$sum['ft_percentage'] = array_sum(array_column($table, 'ft_percentage'));
    	$sum['rebound_defensive'] = array_sum(array_column($table, 'rebound_defensive'));
    	$sum['rebound_offensive'] = array_sum(array_column($table, 'rebound_offensive'));
    	$sum['assist'] = array_sum(array_column($table, 'assist'));
    	$sum['steal'] = array_sum(array_column($table, 'steal'));
    	$sum['turnover'] = array_sum(array_column($table, 'turnover'));
    	$sum['block_fw'] = array_sum(array_column($table, 'block_fw'));
    	$sum['block_ag'] = array_sum(array_column($table, 'block_ag'));
    	$sum['foul_cm'] = array_sum(array_column($table, 'foul_cm'));
    	$sum['foul_rv'] = array_sum(array_column($table, 'foul_rv'));
    	$sum['value'] = array_sum(array_column($table, 'value'));

    	if ($numRows > 0) {
	    	foreach ($sum as $key => $value) {
	    		$avg[$key] = round(($value / $numRows), 1);
	    	}
    	}

    	$sum['percentage'] = $avg['percentage'];
    	$sum['fg2_percentage'] = $avg['fg2_percentage'];
    	$sum['fg3_percentage'] = $avg['fg3_percentage'];
    	$sum['ft_percentage'] = $avg['ft_percentage'];

    	$sum = ['game_id' => 'Total', 'date' => ''] + $sum;
    	$avg = ['game_id' => 'Average', 'date' => ''] + $avg;    	

    	$calc[] = $avg;
    	$calc[] = $sum;


    	return $calc;
    }    
}
