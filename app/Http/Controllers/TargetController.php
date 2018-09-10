<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Target;
use App\User;

use DateTime;
use DateInterval;
use ReflectionObject;

class TargetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('recepsion');
    }

    public function addTarget(Request $request)
    {
        $this->validate($request, [
            'target' => 'required'
        ]);
        
        $users = User::where('permissions','recepsion')->get();

        foreach($users as $user) 
        {
            $target = new Target();
            $target->user_id = $user->id;
            $target->target = $request->input('target');
            $target->accomplished = 0;
            $target->active = 1;
            $target->save();
        }

        return back()->with('success','Targeti u percaktua');
    }

    public function expireTarget()
    {
        $targets = Target::where('active','1')->get();
        if(count($targets) > 0) 
        {
            foreach($targets as $target) 
            {
                $created_at = new Datetime($target->created_at);
                $created_at->format('Y-m-d');
        
                $expires_at = new Datetime();
                $expires_at->format('Y-m-d');
                $expires_at = $created_at->modify('+1 month');
                $obj = new ReflectionObject($expires_at);
                $obj_property = $obj->getProperty('date');
                $expires_at_date = $obj_property->getValue($expires_at);
        
                $today_date = new Datetime();
                $today_date->format('Y-m-d');
                $tObj = new ReflectionObject($today_date);
                $tObj_property = $tObj->getProperty('date');
                $today_date_date = $tObj_property->getValue($today_date);
            
                if($today_date_date == $expires_at_date) 
                {
                    $target->active = 0;
                    $target->save();
                }
                else 
                {
                    return 0;
                }
            }
        }      
    }

}
