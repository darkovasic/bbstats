<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public function venue() {
    	return $this->belongsTo(Venue::class);
    }

	public function homeTeam() {
    	return $this->belongsTo(Team::class, 'home_team_id');
    }

	public function awayTeam() {
    	return $this->belongsTo(Team::class, 'away_team_id');
    }

	public function gameStat() {
    	return $this->hasMany(GameStat::class);
    }

    public function teamStat() {
    	return $this->hasMany(TeamStat::class);
    }  
}
