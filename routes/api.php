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
Route::post('/check/cm/{test}/{ue}', 'AjaxController@check_cm')->name('cm_check') ;
Route::post('/check/td/{test}/{ue}', 'AjaxController@check_td')->name('td_check') ;
Route::post('/check/tp/{test}/{ue}', 'AjaxController@check_tp')->name('tp_check') ;
Route::get('/assign/{ue}/{ens}/{cm}/{td}/{tp}','AjaxController@assign')->name('assign') ;
