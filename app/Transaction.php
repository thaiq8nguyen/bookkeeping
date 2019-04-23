<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{


    protected $fillable = ['contact_id', 'date', 'memo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function file()
    {
        return $this->morphOne('App\File', 'fileable');
    }

    public function lineItems()
    {
        return $this->hasMany('App\LineItem')
            ->join('accounts','line_items.account_id','accounts.id')
            ->selectRAW('line_items.transaction_id, accounts.id AS account_id, line_items.amount, accounts.account_name');
    }

    public function lineItemsTotalAmount()
    {
        /*return $this->hasOne('App\LineItem')->selectRaw('transaction_id, SUM(amount) as total')
        ->groupBy('transaction_id');*/

        return $this->hasOne('App\LineItem')
            ->selectRaw('line_items.transaction_id,SUM(amount) as total')->groupBy('line_items.transaction_id');
    }




    /* public function getlineItemsTotalAmountAttribute()
    {
        // if relation is not loaded already, let's do it first
        if (! array_key_exists('lineItemsTotalAmount', $this->relations)) {
            $this->load('lineItemsTotalAmount');
        }

        $related = $this->getRelation('lineItemsTotalAmount');
        // then return the count directly
        return ($related) ? (int) $related->sum : 0;
    } */

    public function getDateAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m/d/Y');
    }

    public function getInvoicingMonthAttribute()
    {
        return Carbon::createFromFormat('m/d/Y', "{$this->date}")->format('F Y');
    }

    public function getDueDateAttribute()
    {
        return Carbon::createFromFormat('m/d/Y', "{$this->date}")->addDays(2)->format('m/d/Y');
    }

}
