<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turn;

class TurnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('recepsion');
    }

    public function checkIfHasTurn()
    {
        $turn = Turn::where('active','1')->count();
        
        if($turn >= 1)
        {
            return 0;
        }
        else 
        {
           if(auth()->user()->is_recepsion()) 
           {    
                $turn = new Turn();
                $turn->user_id = auth()->user()->id;
                $turn->total = 0;
                $turn->active = 1;
                $turn->save();

                return 1;
           } 
           else 
           {
                return 2;  
           } 
        }
    }

    public function deactivateCurrentTurn()
    {
        // deactivate current
        $active_turn = Turn::where('active','1')->first();
        $active_turn->active = 0;
        $active_turn->save();

        return back()->with('success','Turni u mbyll');
    }
}
