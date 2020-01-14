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

Route::get('/home', 'HomeController@open')->name('open') ;

Route::get('/home/enseignant/', 'EnseignantsController@index')->name('enseignant_index') ;
Route::get('/home/enseignant/trashed', 'EnseignantsController@trashed')->name('enseignant_trashed') ;
Route::post('/home/enseignant/new', 'EnseignantsController@insert')->name('enseignant_insert') ;
Route::get('/home/enseignant/{id}/show', 'EnseignantsController@show')->name('enseignant_show') ;
Route::get('/home/enseignant/{id}/delete', 'EnseignantsController@delete')->name('enseignant_delete') ;
Route::get('/home/enseignant/{id}/purge', 'EnseignantsController@purge')->name('enseignant_purge') ;
Route::get('/home/enseignant/add', 'EnseignantsController@add')->name('enseignant_add') ;
Route::get('/home/enseignant/{id}/alter', 'EnseignantsController@edit')->name('enseignant_alter') ;
Route::post('/home/enseignant/{id}/update', 'EnseignantsController@update')->name('enseignant_update') ;
Route::get('/home/enseignant/{id}/restore', 'EnseignantsController@restore')->name('enseignant_restore') ;
Route::post('/home/enseignant/infos', 'EnseignantsController@infos')->name('enseignant_infos') ;
Route::get('/home/generate/','EnseignantsController@generatePdf')->name('generate_pdf') ;

Route::get('/home/ues/', 'UesController@index')->name('ues_index') ;
Route::get('/home/ues/trashed', 'UesController@trashed')->name('ues_trashed') ;
Route::post('/home/ues/new', 'UesController@insert')->name('ues_insert') ;
Route::get('/home/ues/{id}/show', 'UesController@show')->name('ues_show') ;
Route::get('/home/ues/{id}/delete', 'UesController@delete')->name('ues_delete') ;
Route::get('/home/ues/{id}/purge', 'UesController@purge')->name('ues_purge') ;
Route::get('/home/ues/add', 'UesController@add')->name('ues_add') ;
Route::get('/home/ues/{id}/alter', 'UesController@edit')->name('ues_alter') ;
Route::post('/home/ues/{id}/update', 'UesController@update')->name('ues_update') ;
Route::get('/home/ues/{id}/restore', 'UesController@restore')->name('ues_restore') ;


Route::get('/home/assignations/', 'AssignationsController@index')->name('assignations_index') ;
Route::get('/home/assignations/trashed', 'AssignationsController@trashed')->name('assignations_trashed') ;
Route::post('/home/assignations/new', 'AssignationsController@insert')->name('assignations_insert') ;
Route::get('/home/assignations/{enseignant}/{ue}/delete', 'AssignationsController@delete')->name('assignations_delete') ;
Route::get('/home/assignations/add', 'AssignationsController@add')->name('assignations_add') ;
Route::get('/home/assignations/{enseignant}/{ue}/alter', 'AssignationsController@edit')->name('assignations_alter') ;
Route::post('/home/assignations/{enseignant}/{ue}/update', 'AssignationsController@update')->name('assignations_update') ;
Route::get('/home/assignations/{enseignant}/{ue}/restore', 'AssignationsController@restore')->name('assignations_restore') ;


Route::post('/home/verify/cm', 'AjaxController@verify_cm')->name('verify_cm') ;
Route::post('/home/verify/td', 'AjaxController@verify_td')->name('verify_td') ;
Route::post('/home/verify/tp', 'AjaxController@verify_tp')->name('verify_tp') ;
