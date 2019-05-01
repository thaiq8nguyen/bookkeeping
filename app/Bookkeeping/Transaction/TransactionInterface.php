<?php

namespace App\Bookkeeping\Transaction;

interface TransactionInterface
{
    public function getTransactions();

    public function getTransaction($transactionID);

    public function createTransaction($transaction);

    public function deleteTransaction($transactionID);

    public function getRenterTransactions($renterID);

    public function getRenterTransaction($transactionID, $renterID);
}
