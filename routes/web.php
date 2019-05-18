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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'NoteController@index');
// Route::get('/index/{first_param?}', 'NoteController@index');
Route::post('/store', 'NoteController@store');
Route::get('/show', 'NoteController@showall');
Route::get('/editshow/{id}', 'NoteController@editshow');
Route::post('/updateNote/{id}', 'NoteController@updateNote');
Route::post('/removeImage/{id}/{image}', 'NoteController@removeImage');

