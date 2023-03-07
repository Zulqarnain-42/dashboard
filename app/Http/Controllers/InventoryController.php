<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class InventoryController extends Controller
{

    public function opening()
    {
        $collectionavailability = Availability::get();
        return view('inventory.opening_stock')->with(compact('collectionavailability'));
    }

    public function updateproductavailability(Request $request)
    {
        $productdata = Product::where('id',$request->productid)->first();

        $productdata->availabilityid = $request->availabilityid;
        $productdata->quantity = $request->quantity;

        $productdata->update();

        return response()->json([
            'success'=>'Record Updated Successfully!'
        ]);
    }
}
