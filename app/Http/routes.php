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

Route::group(['prefix' => 'api', 'middleware' => 'cors'], function () {
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('/authenticate', 'AuthenticateController@authenticate');
    Route::get('/getID','UserController@getLoginID');
    Route::get('/getUsers','UserController@getUsers');
    Route::get('/getProfileInfo','ClientsController@getProfileData');
    Route::get('/home', 'HomeController@index');
    Route::post('/statisticsUser', 'HelpersController@getQuantity');
    Route::post('/signup','RegisterController@signup');    
    Route::get('/getUserApps','UserController@getUserApps');
    Route::post('/createInternalUser','UserController@createInternalUser');
    Route::get('/getClients','ClientsController@getClients');
    Route::post('/saveClient','ClientsController@saveClient');
    Route::post('/updateClient','ClientsController@updateClient');
    Route::post('/deleteClient','ClientsController@deleteClient');
    Route::post('/updateUserProfile','ClientsController@updateUserProfile');
    Route::post('/updateUserCompany','ClientsController@updateUserCompany');
    Route::get('/getProviders','ProvidersController@getProviders');
    Route::post('/saveProvider','ProvidersController@saveProvider');
    Route::post('/updateProvider','ProvidersController@updateProvider');
    Route::post('/deleteProvider','ProvidersController@deleteProvider');
    Route::post('/updateCompany','CompaniesController@updateCompanyInfo');
    Route::post('/deleteCompany','CompaniesController@deleteCompany');
    Route::get('/getCompanyInfo','CompaniesController@getCompanyInfo');
    Route::get('/getCategories','CategoriesController@getCategories');
    Route::post('/saveCategories','CategoriesController@saveCategories');
    Route::post('/updateCategories','CategoriesController@updateCategories');
    Route::post('/deleteCategories','CategoriesController@deleteCategories');
    Route::post('/getProductStock','MovementsController@getProductStock');
    Route::post('/saveMovements','MovementsController@saveMovements');
    Route::post('/updateMovements','MovementsController@updateMovements');
    Route::post('/deleteMovements','MovementsController@deleteMovements');
    Route::get('/getProducts','ProductsController@getProducts');
    Route::post('/saveProducts','ProductsController@saveProducts');
    Route::post('/updateProducts','ProductsController@updateProducts');
    Route::post('/deleteProducts','ProductsController@deleteProducts'); 
    Route::post('/saveBuyOrder','OrderController@postOrder');
    Route::get('/buyOrderInformation/{id}', 'OrderController@getOrderById');
    Route::get('/getBuyOrders', 'OrderController@getAllOrders');
    Route::post('/deleteOrder/{id}', 'OrderController@deleteOrderById');
    Route::post('/completeOrder/{id}', 'OrderController@completeOrder');
    Route::get('/saleInformation/{id?}', 'SaleController@getSaleInfo');
    Route::post('/createNewSale', 'SaleController@postSale');
    Route::post('/getAfipCae','SaleController@getAfipCae');
});

Route::auth();

Route::get('/home', 'HomeController@index');
