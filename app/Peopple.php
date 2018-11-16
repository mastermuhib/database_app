<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peopple extends Model
{
    protected $table = 'peopples';
    Protected $fillable = [
        'id',
        'daerahs_id',
        'desas_id',
        'kelompoks_id',
        'name',
        'addres', 
        'phone',
        'birthday',
        'status'
    ];
}
