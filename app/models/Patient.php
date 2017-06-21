<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use SoftDeletes, Notifiable;

    protected $guarded = ['id'];
    protected $hidden = ['deleted_at'];

    public function getFullNameAttribute()
    {
        return ucwords($this->attributes['first_name'] . ' ' . $this->attributes['middle_name']. ' ' . $this->attributes['last_name']);
    }
}
