<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

      public function rules()
    {
        return $this->belongsToMany(Rule::class);
    }
    /*
    * Method untuk menambahkan role (hak akses) baru pada user
    */ 
    public function putRule($rule)
    {
        if (is_string($role))
        {
            $rule = Rule::whereRuleName($rule)->first();
        }
        return $this->rules()->attach($rule);
    }
    /*
    * Method untuk menghapus role (hak akses) pada user
    */ 
    public function forgetRule($rule)
    {
        if (is_string($rule))
        {
            $rule = Rule::whereRuleName($rule)->first();
        }
        return $this->rules()->detach($rule);
    }
    /*
    * Method untuk mengecek apakah user yang sedang login punya hak akses untuk mengakses page sesuai rolenya
    */ 
    public function hasRule($ruleName)
    {
        foreach ($this->rules as $rule)
        {
            if ($rule->rule_name === $ruleName) return true;
        }
            return false;
    }
}

