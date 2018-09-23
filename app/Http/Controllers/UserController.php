<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Target;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superuser');
    }

    public function index()
    {
        $users = User::where('activated',1)->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'email' => 'required',
            'permissions' => 'required',
            'password' => 'required|min:6',
            'konfirmo_password' => 'required'
        ]);

        if($request->input('password') === $request->input('konfirmo_password'))
        {
            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->permissions = $request->input('permissions');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $active_target = Target::where('active','1')->first();
            // create target
            $new_target = new Target();
            $new_target->user_id = $user->id;
            $new_target->target = $active_target->target;
            $new_target->accomplished = 0;
            $new_target->active = 1;
            $new_target->created_at = $active_target->created_at;
            $new_target->save();

            return back()->with('success','Useri u shtua');
        } 
        else 
        {
            return back()->with('error','Fjalekalimet nuk perputhen !');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'email' => 'required',
            'permissions' => 'required',
        ]);

        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->permissions = $request->input('permissions');
        $user->save();

        return redirect()->route('users.index')->with('success','Useri u redaktua');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $target = Target::where('user_id',$user->id);
        $target->delete();

        return back()->with('success','Useri u fshi');
    }
}
