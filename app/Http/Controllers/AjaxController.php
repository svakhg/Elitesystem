<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Bar;
use App\Subscription;
use App\Installment;
use App\Purchases;
use App\Member;
use App\Activity;
use App\Turn;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getProdouctPriceById($id)
    {
    	$product = Bar::find($id);
    	$product_price = $product->price;

    	return $product_price;
    }

    public function getProductQtyById($id)
    {
    	$product = Bar::find($id);
    	$product_qty = $product->actual;

    	return $product_qty;
    }

    public function checkIfAlreadySybscribed($id)
    {
        $subscription = Subscription::where('member_id',$id)->where('status','1')->get();

        return count($subscription);
    }

    public function getUserDebtById($id)
    {
        $subscription = Subscription::where('member_id',$id)->where('payed_price','installment')->where('status','1')->first();
        
        if(!empty($subscription))
        {
            $installment = Installment::where('subscription_id',$subscription->id)->get();

            return $installment;
        } 
    }

    public function addRecievmentBySubscriptionId($id) 
    {
        if($id) 
        {
            $installment = Installment::where('subscription_id',$id)->first();
            $installment->payed += Input::get('sum');
            $installment->save();

            // shto ne totali i turnit
            $turn = Turn::where('active','1')->first();
            $turn->total = $turn->total + Input::get('sum');
            $turn->save();

            if((int)$installment->payed >= (int)$installment->price) 
            {
                $subscription = Subscription::find($id);
                $subscription->payed_price = 'payed';
                $subscription->save();

                return 0;
            }
        }
    }

    public function getMemberDebtById($id) 
    {
        $member = Member::find($id);
        $debt = 0;

        foreach($member->unpayed_purchases as $unpayed) 
        {
            $debt += $unpayed->price;
        }
        
        if($debt >= 200) 
            return 1;
        else 
            return 0;    
    }

    public function getCheckInUsers()
    {
        $time = (int)date('H');

        $members = [];

        $all_members = Member::all();

        foreach($all_members as $member)
        {
            // kthe si rezultat user qe kane abonim aktiv
            if($member->subscription)
            {
                if($member->subscription->status == 1 && $member->subscription->deleted == 0)
                {
                    //shto ne array sipas orarit te abonimit
                    if($member->subscription->package->time == 1) 
                    {
                        if($time < 16)
                        {
                            array_push($members,$member);
                        } 
                    } 
                    else if ($member->subscription->package->time == 2) 
                    {
                        if($time >= 16) 
                        {
                            array_push($members, $member);
                        }
                    }
                    else if ($member->subscription->package->time == 3)
                    {
                        array_push($members, $member);
                    }
                }     
            }
        }

        return response()->json($members);
    }

    public function checkIn($id)
    {
        $member = Member::find($id);
        // update -1 nr e seancave
        $sessions = $member->subscription->sessions_left;
        $sessions -= 1;
        $member->subscription->sessions_left = $sessions;
        $member->subscription->save();

        $activity = Activity::where('member_id',$member->id)->count(); // fix count
        
        if($activity < 1) 
        {
            // nuk ka rresht ne tabela aktivitet
            $new_activity = new Activity();
            $new_activity->member_id = $member->id;
            $new_activity->active = 1;
            $new_activity->save();
        } 
        else 
        {
            // ka rresht ne tabela aktivitet 
            $active_activity = Activity::orderBy('updated_at','DESC')->where('member_id',$member->id)->first();
            // nqs aktiviteti eshte aktiv 
            if($active_activity->active == 1) 
            {
                // kthe 0 (mesazh errori)
                return 0;
            } 
            else 
            {
                // update kolonen aktive nga 0 ne 1
                $active_activity->active = 1;
                $active_activity->save();
            }
        }

        return 1;
    }

    public function checkOut($id)
    {
        $activity = Activity::find($id);
        $activity->active = 0;
        $activity->save();
    }

    public function searchMember(Request $request)
    {
        $name = $request->input('name');
        $searchPhrase = explode(' ', $name)[0];

        $members = Member::where('first_name','LIKE','%'.$searchPhrase.'%')
                        ->orWhere('last_name','LIKE','%'.$searchPhrase.'%')
                        ->paginate(10);

        return view('members.search', compact('members'));
    }

    public function payDebt($id, Request $request) 
    {
        $member = Member::find($id);
        $total = $request->total;

        // shto ne totali i turnit
        $turn = Turn::where('active','1')->first();
        $turn->total = $turn->total + $total;
        $turn->save();

        if($member->unpayed_purchases) 
        {
            foreach($member->unpayed_purchases as $debt)
            {
                $debt->status = 'paguar';
                $debt->save();
            }
        }
    }

    public function autosugguest($name) 
    {
        $members = Member::where('first_name','LIKE','%'.$name.'%')
                        ->orWhere('last_name','LIKE','%'.$name.'%')
                        ->get();

        return $members;
    }
}
