<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Purchase;
use App\Bar;
use App\Turn;
use App\Towel;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('bar');
    }

    public function index()
    {
        $purchases = Purchase::orderBy('created_at','DESC')->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required|min:1',
            'price' => 'required',
            'status' => 'required',
        ]);

        $buyer_id = $request->input('buyer_id');

        if($buyer_id == null || $buyer_id = '') 
        {
            return back()->with('error','Zgjidh Konsumatorin');
        }

        if($request->input('buyer_type') == 'member') 
        {
            $buyer_type = 'App\Member';
        }
        else if ($request->input('buyer_type') == 'user')
        {
            $buyer_type = 'App\User';
        } 
        else 
        {
            return back();
        }

        $purchase = new Purchase();
        $purchase->buyer_id = $request->input('buyer_id');
        $purchase->buyer_type = $buyer_type;
        $purchase->product_id = $request->input('product_id');
        if($request->input('product_type')) 
        {
            // Modifiko tabelen e peshqirave 
            $towel = Towel::find($request->input('product_id'));
            $towel->member_id = $request->input('buyer_id');
            $towel->active = 0;
            $towel->save();
            
            $purchase->product_type = $request->input('product_type');
        }
        $purchase->quantity = $request->input('quantity');
        $purchase->price = $request->input('price');
        $purchase->status = $request->input('status');
        $purchase->save();

        $product = Bar::find($request->input('product_id'));
        
        if($product->countable == 1) {
            $new_actual = $product->actual - $request->quantity;
            $product->actual = $new_actual;
            $product->save();
        }

        // shto ne totali i turnit
        $status = $purchase->status;
        
        if($status == 'paguar')
        {
            $turn = Turn::where('active','1')->first();
            $turn->total = $turn->total + $purchase->price;
            $turn->save();
        }

        return back()->with('success','Blerja u krye');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->status = 'paguar';
        $purchase->save();

        // shto ne totali i turnit
        $turn = Turn::where('active','1')->first();
        $turn->total = $turn->total + $purchase->price;
        $turn->save();

        return back()->with('success','Blerja e mbartur u pagua');
    }

    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $product_id = $purchase->product_id;
        $product_quantity = $purchase->quantity;
        $product = Bar::find($product_id);
        // rikthe sasine e blere ne gjendjen aktuale te produktit
        $product->actual = $product->actual + $product_quantity;
        $product->save();
        $purchase->delete();

        return back()->with('success','Blerja u anulua');
    }
}
