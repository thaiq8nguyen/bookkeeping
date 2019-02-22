<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookkeeping\ExpenseAccount\ExpenseAccountInterface as ExpenseAccountInterface;

class ExpenseAccountController extends Controller
{
    protected $expenseAccount;

    public function __construct(ExpenseAccountInterface $expenseAccount)
    {
        $this->expenseAccount = $expenseAccount;
    }

    public function getExpenseAccounts()
    {
        return $this->expenseAccount->getExpenseAccounts();
    }

    
}
