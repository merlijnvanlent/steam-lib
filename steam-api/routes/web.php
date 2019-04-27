<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('default');
});


Route::group(['middleware' => ['cors']], function () {

    Route::group(['middleware' => ['PlayerId']], function () {
        Route::get('player' , 'PlayerController@getPlayer');  
        Route::get('player/inventory' , 'PlayerController@getLibrary');

        Route::get('player/friends' , 'PlayerController@getFriends');
        Route::get('player/friendslist' , 'PlayerController@getFriendsList');
    });

    Route::group(['middleware' => ['GameId']], function () {
        Route::get('game' , 'GameController@getGame');  
    });

});