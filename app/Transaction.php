<?php

namespace App;

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
        return $this->hasMany('App\LineItem');
    }

    public function lineItemsTotalAmount()
    {
        return $this->hasOne('App\LineItem')->selectRaw('transaction_id, SUM(amount) as total')
        ->groupBy('transaction_id');
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
}
