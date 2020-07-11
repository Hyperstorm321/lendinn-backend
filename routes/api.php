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

Route::middleware('cors')->group(function(){
    // Route::get('/', 'PeopleController@get');
    // Route::delete('/{id}','PeopleController@delete');
    // Route::put('/{id}', 'PeopleController@put');
    // Route::post('/','PeopleController@post');
    // Route::get('/useraccount/{id}', 'UserAccountController@');
    Route::get('/useraccounts', 'UserAccountController@get');
    // yang api/user na yun boss dito sya nung nag php artisan routes
    //eto yung routes so dito /useraccounts yung route nya tas UseraccountController@get
 });
