<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    protected $fillable = ['transaction_id', 'account_id', 'amount', 'memo', 'reference'];
    protected $hidden = ['created_at', 'updated_at'];

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function account()
    {
        return $this->belongsTo('App\Account')->select(['id','account_name']);
    }
}
