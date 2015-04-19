<?php

$app->get('/', function() {
    return view('index');
});

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
$app->group(['namespace' => 'App\Http\Controllers'], function($group) {
    $group->get('messages', 'MessagesController@index');
    $group->post('messages', 'MessagesController@store');
    $group->put('messages/{id}', 'MessagesController@update');
    $group->delete('messages/{id}', 'MessagesController@destroy');
});
