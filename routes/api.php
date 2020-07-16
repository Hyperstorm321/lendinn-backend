<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//andito pa yung function e
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/useraccounts', 'UserAccountController@get'); 
Route::get('/useraccounts/{id}', 'UserAccountController@individual'); 
Route::get('/usersproperties', 'HomePageController@get');
Route::get('/myproperties/{id}', 'HomePageController@myProperties');

// Reports
Route::get('/list_of_properties_owned/{user_id}', 'ReportController@listOfPropertiesOwned');
Route::get('/landlord/list_of_properties_owned/{landlord_id}', 'ReportController@listOfPropertiesOwnedLandlord');
Route::get('/landlord/sold_properties_in_a_month/{landlord_id}/{year}/{month}', 'ReportController@soldPropertiesInAMonthReport');