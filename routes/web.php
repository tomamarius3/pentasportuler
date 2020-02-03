<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('home');

Route::get('/league/{league}/scoreboard', 'LeagueController@index')
    ->name('league.scoreboard');
Route::get('/league/{league}/matches', 'LeagueController@matches')
    ->name('league.matches');

Route::get('/matches/{match}/edit', 'MatchController@edit')
    ->name('matches.edit');

Route::put('/matches/{match}/update', 'MatchController@update')
    ->name('matches.update');
