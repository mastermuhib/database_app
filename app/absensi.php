<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
   protected $table = 'absensi';
    Protected $fillable = [
        'id',
        'peopple_id', 
        'status', 
        'event_id'
    ];
}
