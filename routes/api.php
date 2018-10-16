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

Route::prefix('v1')->group(function () {
 	Route::group(['middleware' => 'AuthToken'], function () {
 	    
 	    Route::delete('person/delete/{id}', 'PersonController@delete');
		Route::post('person/save', 'PersonController@save');
		Route::post('person/savePersons', 'PersonController@savePersons');
 	    Route::get('person/{wal_id}', 'PersonController@get');
	 	
 	    Route::delete('contact/delete/{id}', 'ContactController@delete');
		Route::post('contact/save', 'ContactController@save'); 
		Route::post('contact/saveContacts', 'ContactController@saveContacts');
     	Route::get('contact/{pgm_id}', 'ContactController@get');
	 	
 	});
 });

