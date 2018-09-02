<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $table = 'installments';

    public function subscription()
    {
    	return $this->belongsTo('App\Subscription');
    }
}
