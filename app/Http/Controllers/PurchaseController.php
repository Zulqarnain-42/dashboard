<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Http\Requests\Purchase\StorePurchaseRequest;

class PurchaseController extends Controller
{
    public function index()
    {
        $collectionpurchase = Purchase::get();
        return view('purchase.index')->with(compact('collectionpurchase'));
    }

    public function store(StorePurchaseRequest $request)
    {
        $request->validate([
            '' => 'required',
            '' => 'required'
        ]);

        $newpurchase = new Purchase();

        $newpurchase->purchasecode;
        $newpurchase->receipt;
        $newpurchase->userid;
        $newpurchase->purchasedate;

        return redirect()->route('purchase.index')->with('success','Purchase Added Successfully!');
    }
}
