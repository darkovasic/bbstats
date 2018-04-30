<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('player_team')) {

            Schema::create('player_team', function (Blueprint $table) {
                // $table->increments('id');
                $table->integer('player_id')->unsigned();
                $table->smallInteger('team_id')->unsigned();
                $table->primary(['player_id', 'team_id']);
                $table->timestamps();
            });
            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_teams');
    }
}
