<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = ['account_type_name','memo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function accounts(){

        return $this->hasMany('App\Account');

    }
}
