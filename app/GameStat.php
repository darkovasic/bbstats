<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameStat extends Model
{
    protected $primaryKey = 'game_id';

	public function game() {
    	return $this->belongsTo(Game::class, 'game_id');
    }    

    public function getRouteKeyName() {
    	return 'game_id';
    }

    public function scopeGetStats($query, $game_id) {
    	return $query->where('game_id', $game_id);
    }
}
