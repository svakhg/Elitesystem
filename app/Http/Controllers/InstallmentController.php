<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Installment;

class InstallmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('recepsion');
    }

    public function index()
    {
        $installments = Installment::all();
        $paginateInstallments = Installment::orderBy('created_at','DESC')->paginate(10);

        return view('installments.index', compact(['paginateInstallments','installments']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        return $request->all();
    }

    public function destroy($id)
    {
        //
    }
}
