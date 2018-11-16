<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class desa extends Model
{
   protected $table = 'desas';
   Protected $fillable = [
        'id',
        'daerahs_id', 
        'name'
    ];
    // public function desa(){

    //     return $this->hasOne(Assign::class);


    // }

}
// class daerah extends Model
// {
//     protected $table = 'daerahs';
//     Protected $fillable = [
//         'id', 'name'
//     ];
// }

