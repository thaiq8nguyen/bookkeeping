<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function renters()
    {
        return $this->belongsToMany('App\Renter')
            ->withPivot(['is_active'])
            ->withTimestamps();
    }

    public function notificationChannel()
    {
        return $this->belongsTo('App\NotificationChannel');
    }
}
