<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Member;
use App\Subscription;
use App\Package;
use App\Activity;
use App\Target;
use App\Turn;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->is_bar()) return redirect('/bar');

        $payed_purchases = Purchase::orderBy('created_at','DESC')->where('status','paguar')->take(10)->get();
        $unpayed_purchases = Purchase::orderBy('created_at','DESC')->where('status','papaguar')->take(10)->get();
        $members_nr = Member::all()->count();
        $subscriptions_nr = Subscription::where('status','1')->count();
        $packages_nr = Package::all()->count();
        $activities = Activity::where('active','1')->get();
        $targets = Target::where('active','1')->get();
        $active_turn = Turn::where('active','1')->first();
        $month_target = Target::where('active','1')->first();

        // foreach($targets as $target)
        // {
        //     $x = (int)$target->target;
        //     $y = (int)$target->accomplished;
        //     $p = $y/$x;
        //     $percentage_accomplished = $p * 100;
        // }

        return view('home', compact([
            'payed_purchases',
            'unpayed_purchases',
            'members_nr',
            'subscriptions_nr',
            'packages_nr',
            'activities',
            'targets',
            'active_turn',
            'month_target'
        ]));
    }
}
