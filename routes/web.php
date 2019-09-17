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

// Default route
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');


Auth::routes();

Route::group(['middleware' => ['auth']], function () {
  Route::get('home', 'PagesController@index')->name('index');
  Route::get('about', 'PagesController@about')->name('about');

  Route::resource('todo', 'TodoController');
});

// Route::get('/home', 'HomeController@index')->name('home');
