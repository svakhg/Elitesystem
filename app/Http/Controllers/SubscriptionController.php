<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Package;
use App\Subscription;
use App\Installment;
use App\Turn;

use DateTime;
use DateInterval;
use ReflectionObject;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $members = Member::all();
        $packages = Package::all();
        $subscriptions = Subscription::orderBy('created_at','DESC')->paginate(15);

        return view('subscriptions.index', compact(['members','packages','subscriptions']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'member_id' => 'required',
        //     'payment_method' => 'required',
        //     'package_id' => 'required',
        //     'starts_at' => 'required'
        // ]);

        // $package = Package::find($request->input('package_id'));
        // $subscription = new Subscription();

        // $subscription->member_id = $request->input('member_id');
        // $subscription->package_id = $request->input('package_id');

        // if($request->input('payment_method') == 0) // e plote 
        //     $subscription->payed_price = 'payed';
        // else if ($request->input('payment_method') == 1) // me keste
        //     $subscription->payed_price = 'installment';

        // // starts at datetime object
        // $starts_at = new Datetime($request->input('starts_at'));
        // $starts_at->format('Y-m-d');    
        // $starts_at_object = new ReflectionObject($starts_at);
        // $starts_at_date_property = $starts_at_object->getProperty('date');
        // $starts_at_date = $starts_at_date_property->getValue($starts_at); 
        // // starts at database field 
        // $subscription->starts_at = $starts_at_date;

        // $expires_at = new Datetime();
        
        // if($package->cycle->months == 0) // eshte abonim ditor
        //     $expires_at = $starts_at->modify('+1 day');
        // else  // eshte abonim mujor
        //     $expires_at = $starts_at->modify('+'.$package->cycle->months.'months');
        
        // $expires_at->format('Y-m-d');
        // $expires_at_object = new ReflectionObject($expires_at);
        // $expires_at_date_property = $expires_at_object->getProperty('date');
        // $expires_at_date = $expires_at_date_property->getValue($expires_at);        
        // // krijo abonim te ri
        // $subscription->expires_at = $expires_at_date;    
        // $subscription->sessions_left = $package->all_sessions;
        // $subscription->status = '1';
        // $subscription->deleted = '0';
        // $subscription->save();
        
        // // krijo pagese me keste
        // if($request->input('payment_method') == 1)
        // {
        //     $installment = new Installment();
        //     $installment->subscription_id = $subscription->id;
        //     $installment->price = $subscription->package->price;
        //     $installment->payed = 0;
        //     $installment->save();
        // } 
        // else if ($request->input('payment_method') == 0) 
        // {
        //     // shto ne totali i turnit
        //     $turn = Turn::where('active','1')->first();
        //     $turn->total = $turn->total + $subscription->package->price;
        //     $turn->save();
        // }

        // return back()->with('success','Abonimi u shtua');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        if($subscription->payed_price == 'payed') 
        {
            $subscription->status = '0';
            $subscription->deleted = '1';
            $subscription->save();

            return back()->with('success','Abonimi u be pasiv');
        } 
        else 
        {
            return back()->with('error','Nuk mund te besh pasiv abonimin pa u paguar');
        }
    }

    public function destroy($id)
    {
        $this->middleware('superuser');
        
        $subscription = Subscription::find($id);
        $installment = $subscription->installment;

        if($subscription->payed_price == 'payed') 
        {
            $subscription->delete();
            
            if($installment) 
                $installment->delete();

            return back()->with('succcess','Abonimi u fshi');
        }
        else
        {
            return back()->with('error','Nuk mund te fshish abonimin pa u paguar');
        } 
    }
}
