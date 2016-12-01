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

Route::get('/', function () {

    $output = "";
    \Artisan::call('route:list');
    return response('Available methods:

' . \Artisan::output(), 200)->header('Content-Type', 'text/plain');
});
