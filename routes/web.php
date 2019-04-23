<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Mail;
use App\Renter;
use App\Transaction;
use Nexmo\Laravel\Facade\Nexmo;

use App\Notifications\InvoiceCreated;

Route::get('/', 'AppController@index');

/*Route::get('/view-invoice', function () {

    $transaction = Transaction::find(52);

    return new App\Mail\InvoiceCreated($transaction);
});*/

/*Route::get('/send-sms', function () {

    //$renter = Renter::find(1);
    $transaction = Transaction::find(52);
    $renter = Renter::find($transaction->transactionable_id);
    //return $transaction->transactionable->full_name;

    //$renter = Renter::find(1);

    $notification = $renter->notifications()->wherePivot('notification_id', 1)->first();

    if ($notification->setting->is_active) {
        return "send";
    } else {
        return "do not send";
    }

   //$renter->notify(new InvoiceCreated($transaction));

});*/

/*Route::get('/recent-transactions', function () {

    $transactions = Transaction::with(['transactionable' => function ($query) {
        $query->select(["id",'first_name', 'last_name']);
    },
        'lineItemsTotalAmount',
        'file' => function ($query) {
            $query->select(['id', 'fileable_id']);
        }
    ])
        ->where('date', '=', '2019-04-18')
        ->orderBy('date', 'desc')
        ->get();

    return $transactions;
});*/
