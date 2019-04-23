<?php

namespace App\Bookkeeping\Transaction;

use App\Transaction;
use App\LineItem;
use App\Renter;
use App\Notifications\InvoiceCreated;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TransactionRepository implements TransactionInterface
{
    public function getTransactions()
    {
        $results = [];

        $year = Carbon::parse('first day of January')->toDateString();

        $transactions = Transaction::with(['transactionable' => function ($query) {
            $query->select(["id",'first_name', 'last_name']);
        },
        'lineItemsTotalAmount',
        'file' => function ($query) {
            $query->select(['id', 'fileable_id']);
        }
        ])
        ->where('date', '>=', $year)
        ->orderBy('date', 'desc')
        ->get();


        foreach ($transactions as $transaction) {
            $result = [
                'transactionID' => $transaction->id, 'date' => $transaction->date, 'memo' => $transaction->memo,
                'renter' => $transaction->transactionable,
                'totalAmount' => $transaction->lineItemsTotalAmount['total'],
                'file' => $transaction->file
            ];

            array_push($results, $result);
        }
        return $results;
    }

    public function getTransaction($transactionID)
    {
        $items = [];


        $transaction = Transaction::find($transactionID);

        $renter = $transaction
            ->transactionable
            ->makeHidden(['last_name','first_name','is_renting','email', 'phone_number']);

        $lineItems = $transaction->lineItems;

        $file = $transaction->file;

        foreach ($lineItems as $lineItem) {
            $item = ['account' => $lineItem->account->account_name, 'amount' => $lineItem->amount];
            array_push($items, $item);
        }

        $results = [
            'renter' => $renter,
            'transaction_id' => $transaction->id,
            'date' => $transaction->date,
            'due_date' => $transaction->due_date,
            'invoicing_month' => $transaction->invoicing_month,
            'lineItems' => $items, 'fileID' => $file->id,
            'memo' => $transaction->memo
        ];

        return $results;
    }

    public function createTransaction($transaction)
    {
        $renter = Renter::find($transaction['renterID']);

        $newTransaction = $renter->transactions()->create(
            ['date' => $transaction['date'], 'memo' => $transaction['memo']]
        );

        foreach ($transaction['lineItems'] as $lineItem) {
            $item = LineItem::create(['transaction_id' => $newTransaction->id, 'account_id' => $lineItem['accountID'],
            'amount' => $lineItem['amount'], 'memo' => $lineItem['memo'], "reference" => $lineItem['reference']]);
        }

        $notification = $renter->notifications()->wherePivot('notification_id', 1)->first();

        if ($notification->setting->is_active) {
            $renter->notify(new InvoiceCreated($newTransaction));
        }

        return ['transactionID' => $newTransaction->id];
    }

    public function deleteTransaction($transactionID)
    {
        $transaction = Transaction::find($transactionID);

        $deletedLineItems = $transaction->lineItems()->delete();

        $deletedPDF = Storage::disk('public')->delete($transaction->file->file_path);

        $deletedFile = $transaction->file()->delete();

        $deletedTransaction = $transaction->delete();


        return [
            'deletedTransaction' => $deletedTransaction,
            'deletedLineItems' => $deletedLineItems,
            'deletedFile' => $deletedFile,
            'deletedPDF' => $deletedPDF
        ];
    }
}
