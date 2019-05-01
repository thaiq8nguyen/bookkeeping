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

    // Authentication

    Route::post('/logout', 'AuthenticationController@logout');


    Route::group(['middleware' => 'admin'], function () {

        // Renters******************************************************************************************************

        Route::get('/renters', 'RenterController@getRenters');


        // Transactions*************************************************************************************************

        Route::get('/transactions', 'TransactionController@getTransactions');

        Route::post('/transactions', 'TransactionController@createTransaction');

        Route::delete('/transactions/{id}', 'TransactionController@deleteTransaction');

        Route::get('/transactions/{id}', 'TransactionController@getTransaction');

        // Files********************************************************************************************************

        Route::post('/files', 'FileController@uploadFile');

        Route::get('/files/{transactionID}', 'FileController@downloadFile');

        // Renter Notifications*****************************************************************************************

        Route::get('/settings/renters-notifications', 'RenterNotificationController@getSettings');

        Route::put('/settings/renters-notifications', 'RenterNotificationController@updateSettings');

        // Accounts*****************************************************************************************************

        Route::get('/expense-accounts', 'ExpenseAccountController@getExpenseAccounts');
    });

    Route::group(['middleware' => ['renter', 'renter.id']], function () {

        // Transactions*************************************************************************************************

        Route::get('/transactions/renters/{renterID}', 'TransactionController@getRenterTransactions');

        Route::group(['middleware' => ['renter.transaction']], function () {

            Route::get(
                '/renters/{renterID}/transactions/{transactionID}',
                'TransactionController@getRenterTransaction'
            );
        });
    });
});











// Route::get('/transactions', 'TransactionController@getTransactions');
