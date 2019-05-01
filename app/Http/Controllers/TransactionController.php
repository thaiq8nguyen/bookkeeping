<?php

namespace App\Http\Controllers;

use App\Renter;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Bookkeeping\Transaction\TransactionInterface as TransactionInterface;

class TransactionController extends BaseController
{
    protected $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getTransactions()
    {
        $results = $this->transaction->getTransactions();

        return response()->json($results);
    }

    public function getTransaction($id)
    {
        return response()->json($this->transaction->getTransaction($id));
    }

    public function createTransaction(Request $request)
    {

        $results = $this->transaction->createTransaction($request->all());

        return response()->json($results);
    }

    public function deleteTransaction($id)
    {
        $result = $this->transaction->deleteTransaction($id);

        return $this->sendResponse($result, 'The transaction has been deleted');
    }

    public function getRenterTransactions($renterID)
    {
        $result = $this->transaction->getRenterTransactions($renterID);

        return $this->sendResponse($result, 'The renter transactions retrieved successfully');
    }

    public function getRenterTransaction($renterID, $transactionID)
    {
        $result = $this->transaction->getRenterTransaction($renterID, $transactionID);

        return $this->sendResponse($result, 'The renter transaction retrieved successfully');
    }
}
