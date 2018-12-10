<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';
    Protected $fillable = [
        'id',
        'kelompoks_id', 
        'daerahs_id', 
        'desas_id', 
        'name'
    ];
}
