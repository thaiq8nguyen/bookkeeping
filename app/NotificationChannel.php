<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationChannel extends Model
{
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
}
