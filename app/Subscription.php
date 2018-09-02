<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    public function member()
    {
    	return $this->belongsTo('App\Member');
    }

    public function package()
    {
    	return $this->belongsTo('App\Package');
    }

    public function installment()
    {
    	return $this->hasOne('App\Installment');
    }
}
