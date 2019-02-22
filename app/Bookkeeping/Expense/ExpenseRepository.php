<?php

namespace App\Bookkeeping\Expense;
use App\Expense;

class ExpenseRepository implements ExpenseInterface {

    public function getExpenses(){

        return Expense::all();    
    }

    public function createExpenses($expenses){

        $results = [];

        foreach($expenses as $expense){

            $result = Expense::create(['expense_category_id' => $expense['categoryID'], 'amount' => $expense['amount']]);

            array_push($results, $result);

        }

        return $results;
    }
}
