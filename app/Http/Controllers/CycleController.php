<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cycle;

class CycleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superuser');
    }

    public function index()
    {
        $cycles = Cycle::all();
        return view('cycles.index',compact('cycles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'months' => 'required'
        ]);

        $cycle = new Cycle();
        $cycle->name = $request->input('name');
        $cycle->months = $request->input('months');
        $cycle->save();

        return back()->with('success','Cikli u shtua');
    }

    public function edit($id)
    {
        $cycles = Cycle::all();
        $current = Cycle::find($id);

        return view('cycles.edit',compact(['cycles','current']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'months' => 'required'
        ]);

        $cycle = Cycle::find($id);
        $cycle->name = $request->input('name');
        $cycle->months = $request->input('months');
        $cycle->save();

        return back()->with('success','Cikli u redaktua');
    }

    public function destroy($id)
    {
        // $cycle = Cycle::find($id);
        // $cycle->delete();

        // return back()->with('success','Cikli u fshi');
    }
}
