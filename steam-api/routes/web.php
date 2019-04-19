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
    Route::get('account' , 'PlayerController@getPlayer');    
});