<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('home_player_id');
            $table->foreign('home_player_id')->references('id')->on('players');
            $table->integer('away_player_id');
            $table->foreign('away_player_id')->references('id')->on('players');
            $table->integer('phase_id');
            $table->foreign('phase_id')->references('id')->on('phases');
            $table->integer('home_score');
            $table->integer('away_score');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
