<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function () {
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::get('/getID','UserController@getLoginID');
    Route::get('/getUsers','UserController@getUsers');
    Route::get('/getProfileInfo','ClientsController@getProfileData');
    Route::get('/home', 'HomeController@index');
    Route::post('/statisticsUser', 'HelpersController@getQuantity')->middleware('cors');
    Route::post('/signup','RegisterController@signup')->middleware('cors');    
    Route::get('/getUserApps','UserController@getUserApps')->middleware('cors');
    Route::get('/getClients','ClientsController@getClients')->middleware('cors');
    Route::post('/saveClient','ClientsController@saveClient')->middleware('cors');
    Route::post('/updateClient','ClientsController@updateClient')->middleware('cors');
    Route::post('/deleteClient','ClientsController@deleteClient')->middleware('cors');
    Route::post('/updateUserProfile','ClientsController@updateUserProfile')->middleware('cors');
    Route::post('/updateUserCompany','ClientsController@updateUserCompany')->middleware('cors');
    Route::post('/updateCompany','CompaniesController@updateCompanyInfo')->middleware('cors');
    Route::post('/deleteCompany','CompaniesController@deleteCompany')->middleware('cors');
    Route::get('/getCompanyInfo','CompaniesController@getCompanyInfo')->middleware('cors');
});
