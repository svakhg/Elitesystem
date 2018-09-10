<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bar;

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

        return view('inventory.index', compact([
            'products'
        ]));
    }

    public function addSuply(Request $request)
    {
        return $request->all();
    }
}
