<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'targets';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
