<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    protected $table = 'turns';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
