<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
   protected $table = 'event';
    Protected $fillable = [
        'id',
        'user_id',
        'daerahs_id',
        'desas_id',
        'kelompoks_id',
        'kelas_id',
        'name',
    ];
}
