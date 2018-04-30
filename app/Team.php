<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    public function players() {
    	return $this->belongsToMany(Player::class);
    }

    public function venue() {
    	return $this->belongsTo(Venue::class);
    }

	public function game() {
    	return $this->hasMany(Game::class);
    }

	public function standings() {
    	return $this->hasMany(Standing::class);
    }

    public function coach() {
    	return $this->belongsTo(Coach::class);
    }      
   
}
