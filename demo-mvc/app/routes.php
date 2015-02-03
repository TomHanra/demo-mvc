<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you register all of the routes for an application.
| Tell Laravel the URIs it should respond to and give it the Closure to execute when that URI is requested.
|
*/

// Use the film's system as the front page.
Route::get("/", function(){
	return Redirect::to('films');
});

// The film controller handles the films directory of the website.
Route::controller('films', 'FilmController');

// Naming the update route
Route::post('films/update', ['as' => 'film.update', 'uses'=>'FilmController@postUpdate']);