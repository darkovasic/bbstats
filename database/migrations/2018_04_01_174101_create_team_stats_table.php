<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_stats', function (Blueprint $table) {
            // $table->increments('id');
            $table->smallInteger('game_id')->unsigned();
            $table->smallInteger('team_id')->unsigned();
            $table->primary(['game_id', 'team_id']);
            $table->string('on_court'); 
            $table->smallInteger('points')->unsigned();
            $table->decimal('percentage', 4, 1)->unsigned();
            $table->smallInteger('fg2_in')->unsigned();
            $table->smallInteger('fg2_attempts')->unsigned();
            $table->decimal('fg2_percentage', 4, 1)->unsigned();
            $table->smallInteger('fg3_in')->unsigned();
            $table->smallInteger('fg3_attempts')->unsigned();
            $table->decimal('fg3_percentage', 4, 1)->unsigned();
            $table->smallInteger('ft_in')->unsigned();
            $table->smallInteger('ft_attempts')->unsigned();
            $table->decimal('ft_percentage', 4, 1)->unsigned();
            $table->smallInteger('rebound_defensive')->unsigned();
            $table->smallInteger('rebound_offensive')->unsigned();
            $table->smallInteger('assist')->unsigned();
            $table->smallInteger('steal')->unsigned();
            $table->smallInteger('turnover')->unsigned();
            $table->smallInteger('block_fw')->unsigned();
            $table->smallInteger('block_ag')->unsigned();
            $table->smallInteger('foul_cm')->unsigned();
            $table->smallInteger('foul_rv')->unsigned();
            $table->smallInteger('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_stats');
    }
}
