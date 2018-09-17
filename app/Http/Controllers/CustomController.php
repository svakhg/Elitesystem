<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Member;
use App\Towel;

class CustomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updatePhoto(Request $request,$id)
    {
        $this->validate($request, ['photo' => 'required|image|max:2999']);

        $member = Member::find($id);
        $actualPhoto = $member->photo;

        if(!empty($actualPhoto))
        {
            Storage::delete('public/photos/'.$member->photo);
        }

        if($request->file('photo'))
        {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('photo')->getClientOriginalExtension();

            $filenameToStore = $filename.'_'.time().'.'.$ext;

            $path = $request->file('photo')->storeAs('public/photos/',$filenameToStore);

            $member->photo = $filenameToStore;
            $member->save();
        }

        return back()->with('success','Fotoja u ndryshua');
    }

    public function addTowel(Request $request)
    {
        $this->validate($request, ['nr' => 'required']);

        $towelCount = Towel::where('nr',$request->input('nr'))->count();

        if($towelCount == 0) 
        {
            $towel = new Towel();
            $towel->nr = $request->input('nr');
            $towel->save();

            return back()->with('success','Peshqiri u shtua');
        }
        else 
        {
            return back()->with('error','Peshqiri me numer '.$request->input('nr').' ekziston');
        }
    }
}
