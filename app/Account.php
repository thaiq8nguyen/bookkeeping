<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['account_type_id', 'account_name', 'memo', 'is_active'];
    protected $hidden = ['created_at', 'updated_at', 'is_active', 'memo'];

    public function accountType()
    {

        return $this->belongsTo('App\AccountType');
    }

    public function lineItems()
    {
        
        return $this->hasMany('App\LineItem');
    }

    public function getAccountNameAttribute($accountName)
    {
        return ucfirst($accountName);
    }
}
