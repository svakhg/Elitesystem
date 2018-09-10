<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Towel extends Model
{
    protected $table = 'towels';

    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}
