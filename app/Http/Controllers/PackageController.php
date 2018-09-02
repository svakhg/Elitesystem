<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Service;
use App\Cycle;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superuser');
    }

    public function index()
    {
        $packages = Package::orderBy('created_at','DESC')->paginate(10);
        $services = Service::all();
        $cycles = Cycle::all();

        return view('packages.index', compact([
            'packages',
            'services',
            'cycles'
        ]));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'service' => 'required',
            'cycle' => 'required',
            'all_sessions' => 'required|min:1',
            'week_sessions' => 'required|min:1',
            'time' => 'required',
            'price' => 'required'
        ]);

        $package = new Package();
        $package->service_id = $request->input('service');
        $package->cycle_id = $request->input('cycle');
        $package->all_sessions = $request->input('all_sessions');
        $package->week_sessions = $request->input('week_sessions');
        $package->time = $request->input('time');
        $package->price = $request->input('price');
        $package->save();

        return back()->with('success','Paketa u krijua');
    }

    public function edit($id)
    {
        $package = Package::find($id);
        $services = Service::all();
        $cycles = Cycle::all();

        return view('packages.edit', compact([
            'package',
            'services',
            'cycles'
        ]));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'service' => 'required',
            'cycle' => 'required',
            'all_sessions' => 'required|min:1',
            'week_sessions' => 'required|min:1',
            'time' => 'required',
            'price' => 'required'
        ]);

        $package = Package::find($id);
        $package->service_id = $request->input('service');
        $package->cycle_id = $request->input('cycle');
        $package->all_sessions = $request->input('all_sessions');
        $package->week_sessions = $request->input('week_sessions');
        $package->time = $request->input('time');
        $package->price = $request->input('price');
        $package->save();

        return redirect()->route('packages.index')->with('success','Paketa u redaktua');
    }

    public function destroy($id)
    {
        // $package = Package::find($id);
        // $package->delete();

        // return back()->with('success','Paketa u fshi');
    }
}
