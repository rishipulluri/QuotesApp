<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
This route applies the 'web' middleware group to every route 
it contains. The "web" middleware group is defined in your HTTP
kernel and include sthe session state, CSRF protection and more.
*/
Route::group(['middleware' => ['web']],function() {
    Route::get('/', function() {
        return view('index');
    });

});