<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
	public function city() {
    	return $this->belongsTo(City::class);
    }

    public function teams() {
    	return $this->hasMany(Team::class);
    }

	public function game() {
    	return $this->hasMany(Game::class);
    }    
}
