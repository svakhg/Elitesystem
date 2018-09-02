<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name','last_name','permissions','activated','last_login','name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // polymorphic (users,members)
    public function purchases()
    {
        return $this->morphMany('App\Purchase','buyer');
    }

    public function is_superuser()
    {
        if($this->permissions == 'superuser')
        {
            return true;
        }

        return false;
    }

    public function is_recepsion()
    {
        if($this->permissions == 'recepsion')
        {
            return true;
        }
        return false;
    }

    public function is_bar()
    {
        if($this->permissions == 'bar')
        {
            return true;
        }
        return false;
    }

    public function activity()
    {
        return $this->hasOne('App\Activity');
    }

    public function turns()
    {
        return $this->hasMany('App\Turn');
    }

}
