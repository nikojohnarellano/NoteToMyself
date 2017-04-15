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

Route::group(['middleware' => ['web']], function () {
  Route::get('/', function () {
      return view('welcome');
  });

  Auth::routes();

  Route::get('/unlock', 'UnlockController@index');
  Route::post('/unlock', 'UnlockController@unlock');
  Route::get('/home', 'HomeController@index');
  Route::get('/activate', 'ActivateController@activate_user');
  Route::post('/save/{user}', 'AppController@index');
});
