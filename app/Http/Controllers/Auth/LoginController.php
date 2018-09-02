<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Turn;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if(Auth::attempt(['email' => $request->email , 'password' => $request->password]))
        {
            $user = User::where('email',$request->email)->first();
            $user->last_login = date("Y-m-d H:i:s");
            $user->save();

            $turn = Turn::where('active','1')->count();
        
            if(!$turn >= 1)
            {
                if($user->is_recepsion()) 
                {    
                    $turn = new Turn();
                    $turn->user_id = $user->id;
                    $turn->total = 0;
                    $turn->active = 1;
                    $turn->save();
                }    
            }

            return redirect()->route('home');
        }
        else 
        {
            // Login Failed
            return back()->with('error','Kredinciale te gabuara !');
        }
    }
}
