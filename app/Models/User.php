<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
      return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function hasRole($name){
      foreach($this->roles as $role){
        if($role->name == $name) return true;
      }
      return false;
    }
    public function assignRole($role){
      return $this->roles()->attach($role);
    }
    public function removeRole($role){
      return $this->roles()->detach($role);
    }
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }
}