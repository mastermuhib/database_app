<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'rule_name', 'created_at', 'updated_at'
	];
	public function getUserObject()
    	{
    		return $this->belongsToMany(User::class)->using(UserRule::class);
    	}
}
