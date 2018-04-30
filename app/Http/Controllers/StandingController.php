<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Standing;

class StandingController extends Controller
{
    public function show() {

    	$standing = Standing::all();
    	$table = json_decode(json_encode($standing), true);

    	

    	$i=0;
    	foreach ($table as &$row) {


    		$row['team_id'] = $standing[$i]->team->name;

    		$i++;	
    	}

    	return view('standings.show', compact('table'));
    }
}
