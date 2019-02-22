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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/login', 'AuthenticationController@login');

Route::group(['middleware' => 'auth:api'], function () {
    
    Route::get('/expense-accounts', 'ExpenseAccountController@getExpenseAccounts');

    Route::get('/renters', 'RenterController@getRenters');


    // Transactions
    Route::get('/transactions', 'TransactionController@getTransactions');

    Route::get('/transactions/{id}', 'TransactionController@getTransaction');

    Route::post('/transactions', 'TransactionController@createTransaction');

    Route::delete('/transactions/{id}', 'TransactionController@deleteTransaction');

    // Transactions

    Route::post('/files', 'FileController@uploadFile');

    Route::get('/files/{transactionID}', 'FileController@downloadFile');


    Route::post('/logout', 'AuthenticationController@logout');
});








// Route::get('/transactions', 'TransactionController@getTransactions');
