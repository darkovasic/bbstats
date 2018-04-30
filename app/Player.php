<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Player extends Model
{
    public function teams() {
    	return $this->belongsToMany(Team::class);
    }

    public function role() {
    	return $this->belongsTo(Role::class);
    }

    public function country() {
    	return $this->belongsTo(Country::class);
    }    
}
