<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['category', 'is_active', 'note'];
    protected $hidden = ['created_at', 'updated_at'];
}
