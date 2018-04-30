<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubmitRequest;

class SubmitController extends Controller {

    public function submit(SubmitRequest $request) {

    	$request->flash();
    	$data = $request->validated();

    	if (array_key_exists('player_id', $data)) {
    		return redirect()->route('player', [$data['player_id']]);

    	} elseif (array_key_exists('team_id', $data)) {
    		return redirect()->route('team', [$data['team_id']]);
    	}
    }
}
