<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bookkeeping\Expense\ExpenseInterface as ExpenseInterface;

class ExpenseController extends Controller
{
    protected $expense;

    public function __construct(ExpenseInterface $expense){

        $this->expense =  $expense;
    }

    public function getExpenses(){

        return $this->expense->getExpenses();
    }

    public function createExpenses(Request $request){

        $results = $this->expense->createExpenses($request->all());

        return response()->json($results);
    }
}
