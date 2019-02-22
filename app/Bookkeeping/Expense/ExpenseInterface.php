<?php

namespace App\Bookkeeping\Expense;

interface ExpenseInterface
{
    public function getExpenses();
    public function createExpenses($expenses);
}
