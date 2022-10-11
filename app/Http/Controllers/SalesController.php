<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Http\Requests\Sales\StoreSalesRequest;

class SalesController extends Controller
{
    public function index()
    {
        $collectionsales = Sales::get();
        return view('sales.index')->with(compact('collectionsales'));
    }

    public function store(StoreSalesRequest $request)
    {
        $request->validate([
            'receipt' => 'required',
            'saledate' => 'required'
        ]);

        $newsales = new Sales();
        $newsales->salescode;
        $newsales->receipt;
        $newsales->userid;
        $newsales->saledate;

        $newsales->save();

        return redirect()->route('sales.index')->with('success','Sales Added Successfully!');
    }
}
