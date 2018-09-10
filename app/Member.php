<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    public function payed_purchases()
    {
    	return $this->morphMany('App\Purchase','buyer')->where('status','paguar');
    }

    public function unpayed_purchases()
    {
    	return $this->morphMany('App\Purchase','buyer')->where('status','papaguar');
    }

    public function subscription()
    {
    	return $this->hasOne('App\Subscription')->where('status','1');
    }

    public function is_debtor()
    {
        if($this->subscription->payed_price == 'installment') 
            return true;
        else 
            return false;
    }

    public function towel()
    {
        return $this->hasOne('App\Towel');
    }
}
