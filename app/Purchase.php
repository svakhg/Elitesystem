<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';

    public function buyer()
    {
    	return $this->morphTo();
    }

    public function product()
    {
    	return $this->morphTo();
    }
}
