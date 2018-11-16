<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelompok extends Model
{
    protected $table = 'kelompoks';
    Protected $fillable = [
        'id',
        'daerahs_id',
        'desas_id', 
        'name'
    ];
}
