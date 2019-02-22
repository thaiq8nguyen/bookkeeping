<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['full_name'];

    public function transactions()
    {
        return $this->morphMany('App\Transaction', 'transactionable');
    }

    public function lineItems()
    {
        return $this->transactions()->join('line_items', 'transactions.id', 'line_items.transaction_id')
        ->selectRaw('line_items.transaction_id, sum(line_items.amount) as total')->groupBy('line_items.transaction_id');
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name). ' ' .ucfirst($this->last_name);
    }
}
