<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    
    public function service()
    {
    	return $this->belongsTo('App\Service');
    }

    public function cycle()
    {
    	return $this->belongsTo('App\Cycle');
    } 

    public function subscription()
    {
    	return $this->belongsTo('App\Subscription');
    }
    
}
