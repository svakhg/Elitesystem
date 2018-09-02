<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superuser');
    }

    public function index()
    {
        $services = Service::all();

        return view('services.index',compact('services'));
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3'
        ]);

        $service = new Service();
        $service->name = $request->input('name');
        $service->save();

        return back()->with('success','Shërbimi u krijua');
    }

    public function edit($id)
    {
        $services = Service::all();
        $current = Service::find($id);
        
        return view('services.edit',compact(['services','current']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required|min:3']);

        $service = Service::find($id);
        $service->name = $request->input('name');
        $service->save();

        return back()->with('success','Shërbimi u redaktua');
    }

    public function destroy($id)
    {
        // $service = Service::find($id);
        // $service->delete();

        // return back()->with('success','Shërbimi u fshi');
    }
}
