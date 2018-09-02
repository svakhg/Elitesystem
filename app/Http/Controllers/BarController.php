<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bar;
use App\Member;
use App\User;
use App\Purchase;
use App\Turn;

class BarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('bar');
    }

    public function index()
    {
        $products = Bar::where('actual','!=',0)->get();
        $members = Member::all();
        $users = User::all();
        $purchases = Purchase::orderBy('created_at','DESC')->take(15)->get();

        return view('bar.index', compact(['products','members','users','purchases']));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->is_superuser())
        {
            return back();
        }

        $this->validate($request, [
            'name' => 'required|min:3',
            'qty' => 'required',
            'price' => 'required',
            'countable' => 'required'
        ]);

        $product = new Bar();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->init = $request->input('qty');
        $product->actual = $request->input('qty');
        $product->countable = $request->input('countable');
        $product->save();

        return back()->with('success','Produkti i ri u shtua');
    }

    public function edit($id)
    {
        if(!auth()->user()->is_superuser())
        {
            return back();
        }

        $product = Bar::find($id);

        return view('bar.edit',compact('product'));
    }

    public function update(Request $request, $id)
    {
        if(!auth()->user()->is_superuser())
        {
            return back();
        }

        $this->validate($request, [
            'name' => 'required|min:3',
            'qty' => 'required',
            'price' => 'required',
            'countable' => 'required'
        ]);

        $product = Bar::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->init = $request->input('qty');
        $product->actual = $request->input('qty');
        $product->countable = $request->input('countable');
        $product->save();

        return redirect()->route('bar.index')->with('success','Produkti u redaktua');
    }

    public function destroy($id)
    {
        if(!auth()->user()->is_superuser())
        {
            return back();
        }

        $product = Bar::find($id);
        $product->delete();

        return back()->with('success','Produkti u fshi');
    }
}
