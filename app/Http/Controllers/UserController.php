<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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

        return back()->with('success','Useri u fshi');
    }
}
