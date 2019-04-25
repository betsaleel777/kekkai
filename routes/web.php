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
    return view('started');
})->name('start');

Route::get('/home','HomeController@open')->name('open') ;

Route::get('/home/enseignant/','EnseignantsController@index')->name('enseignant_index') ;
Route::get('/home/enseignant/trashed','EnseignantsController@trashed')->name('enseignant_trashed') ;
Route::post('/home/enseignant/new','EnseignantsController@insert')->name('enseignant_insert') ;
Route::get('/home/enseignant/{id}/show','EnseignantsController@show')->name('enseignant_show') ;
Route::get('/home/enseignant/{id}/delete','EnseignantsController@delete')->name('enseignant_delete') ;
Route::get('/home/enseignant/{id}/purge','EnseignantsController@purge')->name('enseignant_purge') ;
Route::get('/home/enseignant/add','EnseignantsController@add')->name('enseignant_add') ;
Route::get('/home/enseignant/{id}/alter','EnseignantsController@edit')->name('enseignant_alter') ;
Route::put('/home/enseignant/{id}/update','EnseignantsController@update')->name('enseignant_update') ;


Route::get('/home/ues/','UesController@index')->name('ues_index') ;
Route::get('/home/ues/trashed','UesController@trashed')->name('ues_trashed') ;
Route::post('/home/ues/new','UesController@insert')->name('ues_insert') ;
Route::get('/home/ues/{id}/show','UesController@show')->name('ues_show') ;
Route::get('/home/ues/{id}/delete','UesController@delete')->name('ues_delete') ;
Route::get('/home/ues/{id}/purge','UesController@purge')->name('ues_purge') ;
Route::get('/home/ues/add','UesController@add')->name('ues_add') ;
Route::get('/home/ues/{id}/alter','UesController@edit')->name('ues_alter') ;
Route::put('/home/ues/{id}/update','UesController@update')->name('ues_update') ;
