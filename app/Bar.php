<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $table = 'bar';

    public function purchase()
    {
    	return $this->morphMany('App\Purchase','product');
    }

    
}
