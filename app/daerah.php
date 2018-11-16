<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daerah extends Model
{
    protected $table = 'daerahs';
    Protected $fillable = [
        'id', 'name'
    ];
}
