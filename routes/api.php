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
	
	Route::delete('person/delete/{id}', 'PersonController@delete');
	Route::post('person/save', 'PersonController@savePerson');
	Route::post('person/savePersons', 'PersonController@savePersons');
	Route::get('person/get/{id}', 'PersonController@get');
	Route::get('person/all', 'PersonController@retrivePersons');
	
	Route::delete('contact/delete/{id}', 'ContactController@delete');
	Route::post('contact/save', 'ContactController@saveContact'); 
	Route::post('contact/saveContacts', 'ContactController@saveContacts');
	Route::get('contact/get/{id}', 'ContactController@get');
	Route::get('contact/all', 'ContactController@retriveContacts');

 });

