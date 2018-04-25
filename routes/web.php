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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/tech', 'PagesController@services');

Route::resource('dashboard', 'FilesController');

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/about', function () {
//    return view('pages.about');
//});

//Route::get('/users/{id}/{name}', function ($id, $name) {
//    return 'this is user ' . $name . ' with id ' . $id;
//});

Route::get('/', ['middleware' =>'guest', function(){
  return view('auth.login');
}]);

Auth::routes();

Route::get('dashboard', 'DashboardController@index');

Route::get('search', 'DashboardController@search');

Route::get('download/{id}', 'FilesController@download');

Route::get('destroy/{id}', 'FilesController@destroy');