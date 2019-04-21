<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('default');
});

Route::group(['middleware' => ['PlayerId']], function () {
    Route::get('player' , 'PlayerController@getPlayer');  
    Route::get('player/inventory' , 'PlayerController@getLibrary');  
});

Route::group(['middleware' => ['GameId']], function () {
    Route::get('game' , 'GameController@getGame');  
});