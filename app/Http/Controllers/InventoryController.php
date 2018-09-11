<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bar;
use App\Supply;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superuser');
    }

    public function index()
    {
        $products = Bar::all();
        $countable_products = Bar::where('countable','1')->get();
        $supplies = Supply::all();

        return view('inventory.index', compact([
            'products',
            'countable_products',
            'supplies'
        ]));
    }

    public function addSuply(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|not_in:0',
            'quantity' => 'required'
        ]);

        $product = Bar::find($request->input('product_id'));
        $product->init += $request->input('quantity');
        $product->actual += $request->input('quantity');
        $product->save();

        // shto ne tabela e furnizimeve
        $supply = new Supply();
        $supply->product = $product->name;
        $supply->quantity = $request->input('quantity');
        $supply->waste = $request->input('waste');
        $supply->save();

        return back()->with('success','Furnizimi u krye');
    }

    public function deleteSupply($id)
    {
        $supply = Supply::find($id);
        $supply->delete();

        return back()->with('success','Furnizimi u fshi');
    }
}
