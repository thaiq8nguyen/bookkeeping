<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Renter extends Model
{
    use Notifiable;
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['full_name'];

    public function transactions()
    {
        return $this->morphMany('App\Transaction', 'transactionable');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification')
            ->as('setting')
            ->withPivot(['is_active'])
            ->withTimestamps();
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }




}
