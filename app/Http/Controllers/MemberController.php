<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Member;
use App\Purchase;
use App\Package;
use App\Activity;
use App\Target;
use App\User;

use DateTime;
use DateInterval;
use ReflectionObject;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('recepsion');
    }

    public function index()
    {
        $members = Member::orderBy('created_at','DESC')->paginate(10);

        return view('members.index', compact(['members']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'photo' => 'image|max:2999'
        ]);

        if($request->file('photo'))
        {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('photo')->getClientOriginalExtension();

            $filenameToStore = $filename.'_'.time().'.'.$ext;

            $path = $request->file('photo')->storeAs('public/photos/',$filenameToStore);
        }

        $member = new Member();
        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->gender = $request->input('gender');
        $member->email = $request->input('email');
        $member->phone = $request->input('phone');

        if(isset($filenameToStore)) 
        {
            $member->photo = $filenameToStore;
        }
        else 
        {
            $member->photo = '';
        }
        $member->save();

        // shto ne targeti mujor
        $current_user = auth()->user();
        
        if($current_user->permissions == 'recepsion')
        {
            $current_user->target->accomplished +=1;
            $current_user->target->save();
        }

        return redirect()->route('members.index')->with('success','Antari i ri u krijua');
    }

    public function show($id)
    {
        $member = Member::find($id);

        return view('members.show', compact('member'));
    }

    public function edit($id)
    {
        if(!auth()->user()->is_superuser())
        {
            return back();
        }

        $member = Member::find($id);
        $packages = Package::all();

        return view('members.edit', compact(['member','packages']));
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->is_superuser())
        {
            return back();
        }

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
        ]);

        $member = Member::find($id);
        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->gender = $request->input('gender');
        $member->email = $request->input('email');
        $member->phone = $request->input('phone');
        $member->save();

        // redakto paketen 
        if($request->input('package_id') !== null || $request->input('package_id') !== '')
        {
            $member->subscription->package_id = $request->input('package_id');
            $member->subscription->save();    
        }  
        
        // redakto daten e filleses se abonimit 
        if($request->input('starts_at') !== null || $request->input('starts_at') !== '')
        {
            // starts at datetime object
            $starts_at = new Datetime($request->input('starts_at'));
            $starts_at->format('Y-m-d');    
            $starts_at_object = new ReflectionObject($starts_at);
            $starts_at_date_property = $starts_at_object->getProperty('date');
            $starts_at_date = $starts_at_date_property->getValue($starts_at); 

            $expires_at = new Datetime();
            
            if($member->subscription->package->cycle->months == 0) // eshte abonim ditor
                $expires_at = $starts_at->modify('+1 day');
            else  // eshte abonim mujor
                $expires_at = $starts_at->modify('+'.$member->subscription->package->cycle->months.'months');
            
            $expires_at->format('Y-m-d');
            $expires_at_object = new ReflectionObject($expires_at);
            $expires_at_date_property = $expires_at_object->getProperty('date');
            $expires_at_date = $expires_at_date_property->getValue($expires_at);        
            
            // update db records
            $member->subscription->starts_at = $request->input('starts_at');
            $member->subscription->expires_at = $expires_at_date;
            $member->subscription->save();
        } 

        return redirect()->route('members.index')->with('success','Antari '.$member->first_name.' '.$member->last_name.' u readktua');
    }

    public function destroy($id)
    {
        if(!auth()->user()->is_superuser())
        {
            return back();
        }
        
        $member = Member::find($id);

        if($member->subscription && $member->subscription->payed_price == 'installment') 
        {
            if($member->is_debtor()) 
                return back()->with('error','Nuk mund te fshish nje debitor');
        }

        $member->delete();
        
        if(!empty($member->photo))
        {
            Storage::delete('public/photos/'.$member->photo);
            return back()->with('success','Antari u fshi');
        } 
        else 
        {
            return back()->with('success','Antari u fshi');
        }
        
    }
}
