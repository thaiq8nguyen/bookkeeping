<?php

namespace App\Bookkeeping\ExpenseAccount;

use App\AccountType;

/**
 * Undocumented class
 */
class ExpenseAccountRepository implements ExpenseAccountInterface
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getExpenseAccounts()
    {
        
        //Retrieved expense accounts collection
        $expense = AccountType::with(
            ['accounts' => function ($query) {
                $query->where('is_active', 1)->orderBy('account_name', 'asc');
            }]
        )->where('account_type_name', 'expense')->first();

        
        //Convert the first character of each account name to upper-case
        $results = $expense->accounts->map(
            function ($account, $key) {
                return ['accountName' =>ucwords($account->account_name),
                'accountID' => $account->id];
            }
        );
        return $results;
    }
}
