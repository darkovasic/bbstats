<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        \Menu::make('NavBar', function ($menu) {

            $countRounds = \App\Game::select('round')->whereNotNull('round')->distinct()->get()->count();
            $data = \App\Game::select('id', 'round', 'home_team_id', 'away_team_id')->get();

            // dd($countRounds);

            $teams = \App\Team::all();

            $menu->add('Home')->link->attr(['class' => 'nav-link']);
            $menu->add('Standings', 'standings')->link->attr(['class' => 'nav-link']);


            $menu->add('Teams', ['url' => '#', 'class' => 'nav-item dropdown'])->link->attr(['class' => 'nav-link dropdown-toggle', 'data-toggle' => "dropdown"]);

            foreach ($teams as $team) {
                $menu->add($team->name, ['url' => "team/$team->id", 'parent' => $menu->teams->id, 'class' => 'dropdown-submenu'])->link->attr(['class' => 'dropdown-item']);
            }


            $menu->add('Games', ['url' => '#', 'class' => 'nav-item dropdown'])->link->attr(['class' => 'nav-link dropdown-toggle', 'data-toggle' => "dropdown"]);

            for ($i=1; $i <= $countRounds; $i++) { 

                $menu->add('Round '.$i, ['url' => '#', 'parent' => $menu->games->id, 'class' => 'dropdown-submenu'])->link->attr(['class' => 'dropdown-item dropdown-toggle']);

                foreach ($data as $game) {

                    if ($game->round == $i) $menu->add($game->homeTeam->name.' - '.$game->awayTeam->name, ['url' => "gamestats/$game->id", 'parent' => $menu->{'round'.$i}->id, 'class' => 'dropdown-submenu'])->link->attr(['class' => 'dropdown-item']);
                }
                
            }
        });        

        return $next($request);
    }
}
