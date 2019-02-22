<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['expense_category_id', 'amount', 'note'];
    protected $hidden = ['created_at', 'updated_at'];
}
