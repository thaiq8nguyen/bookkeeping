<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['fileable_type', 'fileable_id', 'file_path', 'memo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function fileable()
    {
        return $this->morphTo();
    }
}
