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
Route::get('/list_of_rented_and_bought_properties/{user_id}', 'ReportController@listOfRentedAndBoughtProperties');
Route::get('/top_5_highest_rented_properties_by_city_in_a_year/{city}/{year}', 'ReportController@top5HighestRentedPropertiesByCityInAYear');
Route::get('/top_5_highest_sold_properties_by_city_in_a_year/{city}/{year}', 'ReportController@top5HighestSoldPropertiesByCityInAYear');
Route::get('/landlord/list_of_owned_properties/{landlord_id}', 'ReportController@listOfOwnedProperties');
Route::get('/landlord/sold_properties_in_a_month/{landlord_id}/{year}/{month}', 'ReportController@soldPropertiesInAMonthReport');
Route::get('/landlord/rented_properties_in_a_month/{landlord_id}/{year}/{month}', 'ReportController@rentedPropertiesInAMonthReport');