<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/enseignants/list', 'EnseignantsController@getList')->name('enseignant_list') ;
Route::get('/ues/list', 'UesController@getList')->name('ue_list') ;
Route::get('/ues/teachers/{id}', 'UesController@getTeacherOf')->name('ue_teachers') ;
Route::get('/enseignants/infos/{id}', 'EnseignantsController@getInfos')->name('enseignant_infos') ;
