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

Route::get('/enseignants/list', 'AjaxController@getListEnseignant')->name('enseignant_list') ;
Route::get('/ues/list', 'AjaxController@getListUe')->name('ue_list') ;
Route::get('/ues/teachers/{id}', 'AjaxController@getTeacherOf')->name('ue_teachers') ;
Route::get('/enseignants/infos/{id}', 'AjaxController@getInfos')->name('enseignant_infos') ;
Route::get('/check/cm/{test}/{ue}', 'AjaxController@check_cm')->name('cm_check') ;
Route::get('/check/td/{test}/{ue}', 'AjaxController@check_td')->name('td_check') ;
Route::get('/check/tp/{test}/{ue}', 'AjaxController@check_tp')->name('tp_check') ;
Route::get('/assign/{ue}/{ens}/{cm}/{td}/{tp}','AjaxController@assign')->name('assign') ;
