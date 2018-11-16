<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class people extends Model
{
   protected $table = 'peoples';
    Protected $fillable = [
        'id',
        'kelompoks_id',
        'name',
        'addres', 
        'phone',
        'birthday',
        'status'
    ];
}
