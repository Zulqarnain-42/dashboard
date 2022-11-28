<?php

namespace App\Http\Controllers;

use App\Http\Requests\Inventory\StoreInventoryRequest;
use App\Http\Requests\Inventory\BookItemRequest;
use App\Http\Requests\Inventory\StoreSalesRequest;
use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class InventoryController extends Controller
{
    public function warehouse()
    {
        $collectioninventory = DB::select('CALL fetchinventory');
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        return view('inventory.warehouse')->with(compact('collectionbrand', 'collectioninventory'));
    }

    public function booking()
    {
        $collectionbooking = DB::select('CALL fetchbookedbyuser("'.Auth()->user()->id.'")');
        $collectionproduct = Product::where([['status', true], ['visibility', true]])->get();
        return view('inventory.booking')->with(compact('collectionproduct','collectionbooking'));
    }

    public function sales()
    {
        $collectioninventory = DB::select('CALL fetchinventory');
        $collectionproduct = Product::where([['status', true], ['visibility', true]])->get();
        return view('inventory.sales')->with(compact('collectionproduct','collectioninventory'));
    }

    public function store(StoreInventoryRequest $request)
    {
        $dbcheck = Product::where('mfr', $request->productmodel)->first();
        if ($dbcheck === null) {
            $products = new Product;
            $products->mfr = $request->productmodel;
            $products->upc = $request->productupc;
            $products->length = $request->length;
            $products->width = $request->width;
            $products->height = $request->heihgt;
            $products->weight = $request->weight;
            $products->brandid = $request->brand;
            $products->price = 0;
            $products->save();

            $inventory = new Inventory();
            $inventory->sharjahquantity = $request->warehousequnatity;
            $inventory->officequantity= $request->officequnatity;
            $inventory->location = $request->location;
            $inventory->product_id = $products->id;
            $inventory->userid = Auth::user()->id;
            $inventory->addedat = Carbon::now();
            $inventory->save();

            return redirect()->route('inventory.warehouse')->with('success','Product Added Successfully!');
        } else {
            return redirect()->route('inventory.warehouse')->with('alert','Product Already Exist!');
        }
    }

    public function quantity(Request $request)
    {
        $inventory = new Inventory();
        $inventory->officequantity = $request->officequnatity;
        $inventory->product_id = $request->productid;
        $inventory->userid = Auth::user()->id;
        $inventory->addedat = Carbon::now();
        $inventory->save();

        return redirect()->route('inventory.warehouse')->with('success','Quantity Updated Successfully!');
    }

    public function officequantity(Request $request)
    {
        $totalsharjah = Inventory::where('product_id', $request->productid)->sum('sharjahquantity');
        $totalfromofficetosharjah = Inventory::where('product_id', $request->productid)->sum('fromofficetosharjah');
        $totaloffice = Inventory::where('product_id', $request->productid)->sum('officequantity');
        $totalfromsharjahtooffice = Inventory::where('product_id', $request->productid)->sum('fromsharhjahtooffice');
        $totalsalequantityfromwarehouse = Inventory::where('product_id', $request->productid)->sum('salequantityfromwarehouse');
        $totalsalequantityfromoffice = Inventory::where('product_id', $request->productid)->sum('salequantityfromoffice');
        $totalbookedquantityfromwarehouse = Inventory::where('product_id', $request->productid)->sum('bookedquantityfromwarehouse');
        $totalbookedquantityfromoffice = Inventory::where('product_id', $request->productid)->sum('bookedquantityfromoffice');

        if ($request->quantityfrom == 0) {
            if (($request->officequantity) > (($totalsharjah + $totalfromofficetosharjah) - $totalfromsharjahtooffice - $totalsalequantityfromwarehouse - $totalbookedquantityfromwarehouse)) {
                return redirect()->route('app.inventory.index');
            }
            $inventory = new Inventory();
            $inventory->fromsharhjahtooffice = $request->officequantity;
            $inventory->product_id = $request->productid;
            $inventory->userid = Auth::user()->id;
            $inventory->addedat = Carbon::now();
            $inventory->save();
        } else {
            if (($request->officequantity) > (($totaloffice + $totalfromsharjahtooffice) - $totalsharjah - $totalsalequantityfromoffice - $totalbookedquantityfromoffice)) {
                return redirect()->route('app.inventory.index');
            }
            $inventory = new Inventory();
            $inventory->fromofficetosharjah = $request->officequantity;
            $inventory->product_id = $request->productid;
            $inventory->userid = Auth::user()->id;
            $inventory->addedat = Carbon::now();
            $inventory->save();
        }
        return redirect()->route('app.inventory.index');
    }

    public function bookitems(BookItemRequest $request)
    {
        $totalsharjah = Inventory::where('product_id', $request->productid)->sum('sharjahquantity');
        $totalfromofficetosharjah = Inventory::where('product_id', $request->productid)->sum('fromofficetosharjah');
        $totaloffice = Inventory::where('product_id', $request->productid)->sum('officequantity');
        $totalfromsharjahtooffice = Inventory::where('product_id', $request->productid)->sum('fromsharhjahtooffice');
        $totalsalequantityfromwarehouse = Inventory::where('product_id', $request->productid)->sum('salequantityfromwarehouse');
        $totalsalequantityfromoffice = Inventory::where('product_id', $request->productid)->sum('salequantityfromoffice');
        $totalbookedquantityfromwarehouse = Inventory::where('product_id', $request->productid)->sum('bookedquantityfromwarehouse');
        $totalbookedquantityfromoffice = Inventory::where('product_id', $request->productid)->sum('bookedquantityfromoffice');

        $inventory = new Inventory();
        if ($request->warehouse == 0) {
            if (($request->soldquantity) > (($totalsharjah + $totalfromofficetosharjah) - $totalfromsharjahtooffice - $totalsalequantityfromwarehouse - $totalbookedquantityfromwarehouse)) {
                return redirect()->route('inventory.booking');
            }
            $inventory = new Inventory();
            $inventory->bookedquantityfromwarehouse = $request->bookedquantity;
            $inventory->bookedby = $request->bookedby;
            $inventory->bookingdate = $request->bookedtilldate;
            $inventory->product_id = $request->productmodel;
            $inventory->customer = $request->customername;
            $inventory->userid = Auth::user()->id;
            $inventory->addedat = Carbon::now();
            $inventory->save();
        } else {
            if (($request->soldquantity) > (($totaloffice + $totalfromsharjahtooffice) - $totalsharjah - $totalsalequantityfromoffice - $totalbookedquantityfromoffice)) {
                return redirect()->route('inventory.booking');
            }
            $inventory = new Inventory();
            $inventory->bookedquantityfromwarehouse = $request->bookedquantity;
            $inventory->bookedby = $request->bookedby;
            $inventory->bookingdate = $request->bookedtilldate;
            $inventory->product_id = $request->productmodel;
            $inventory->customer = $request->customername;
            $inventory->userid = Auth::user()->id;
            $inventory->addedat = Carbon::now();
            $inventory->save();
        }

        return redirect()->route('inventory.booking');
    }

    public function storesales(StoreSalesRequest $request)
    {
        $totalsharjah = Inventory::where('product_id', $request->productid)->sum('sharjahquantity');
        $totalfromofficetosharjah = Inventory::where('product_id', $request->productid)->sum('fromofficetosharjah');
        $totaloffice = Inventory::where('product_id', $request->productid)->sum('officequantity');
        $totalfromsharjahtooffice = Inventory::where('product_id', $request->productid)->sum('fromsharhjahtooffice');
        $totalsalequantityfromwarehouse = Inventory::where('product_id', $request->productid)->sum('salequantityfromwarehouse');
        $totalsalequantityfromoffice = Inventory::where('product_id', $request->productid)->sum('salequantityfromoffice');
        $totalbookedquantityfromwarehouse = Inventory::where('product_id', $request->productid)->sum('bookedquantityfromwarehouse');
        $totalbookedquantityfromoffice = Inventory::where('product_id', $request->productid)->sum('bookedquantityfromoffice');

        $dbcheck = Inventory::where('receipt', $request->salereceipt)->first();
        if ($dbcheck === null) {
            if ($request->warehouse == 0) {
                if (($request->soldquantity) > (($totalsharjah + $totalfromofficetosharjah) - $totalfromsharjahtooffice - $totalsalequantityfromwarehouse - $totalbookedquantityfromwarehouse)) {
                    return redirect()->route('inventory.sales');
                }

                $inventory = new Inventory();
                $inventory->salequantityfromwarehouse = $request->salequantity;
                $inventory->receipt = $request->salereceipt;
                $inventory->product_id = $request->productmodel;
                $inventory->userid = Auth::user()->id;
                $inventory->addedat = Carbon::now();
                $inventory->save();
            } else {
                if (($request->soldquantity) > (($totaloffice + $totalfromsharjahtooffice) - $totalsharjah - $totalsalequantityfromoffice - $totalbookedquantityfromoffice)) {
                    return redirect()->route('inventory.sales');
                }

                $inventory = new Inventory();
                $inventory->salequantityfromoffice = $request->salequantity;
                $inventory->receipt = $request->salereceipt;
                $inventory->product_id = $request->productmodel;
                $inventory->userid = Auth::user()->id;
                $inventory->addedat = Carbon::now();
                $inventory->save();
            }
            return redirect()->route('inventory.sales');
        } else {
            return redirect()->route('inventory.sales');
        }

    }

    public function productdetails($id)
    {
        $productdetails = Product::where('id', $id)->first();
        $inventorydetail = Inventory::where('product_id', $id)->get();
        return view('backend.inventory.productdetails')->with(compact('productdetails', 'inventorydetail'));
    }

    public function opening()
    {
        $collectionbrand = Brand::get();
        return view('inventory.opening_stock')->with(compact('collectionbrand'));
    }

    public function brandopening($brandid = 0)
    {
        Session::put('brandid',$brandid);
        $collectionstock = Product::where('brandid',$brandid)->get();
        Session::put('product_data',$collectionstock);
        return response()->json(['session successfully saved']);
    }

    public function adjustment()
    {
        return view('inventory.stock-adjustment');
    }

    public function storeadjustment()
    {
        return view('inventory.add-adjustment');
    }

    public function purchases()
    {
        return view('inventory.purchase');
    }

    public function salesinventory()
    {
        return view('inventory.sales');
    }
}
