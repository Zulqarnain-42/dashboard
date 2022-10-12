<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\Status;
use App\Models\Visibilty;

class WarehouseController extends Controller
{
    public function index()
    {
        $collectionwarehouse = Warehouse::get();
        $collectionstatus = Status::get();
        return view('warehouse.index')->with(compact('collectionwarehouse','collectionstatus'));
    }

    public function store(StoreWarehouseRequest $request)
    {
        $dbcheck = Warehouse::where([['title', '=', $request->warehouse],
                                    ['address', '=', $request->address],
                                    ['city', '=', $request->city],
                                    ['country', '=', $request->country]])->first();

        if($dbcheck === null){

            $request->validate([
                'warehouse' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required'
            ]);

            $newwarehouse = new Warehouse();
            $newwarehouse->title = $request->warehouse;
            $newwarehouse->address = $request->address;
            $newwarehouse->city = $request->city;
            $newwarehouse->country = $request->country;
            $newwarehouse->status = $request->status;

            $newwarehouse->save();
        }
        else{
            return redirect()->route('warehouse.index')->with('alert','Warehouse Already Exist!');
        }
        return redirect()->route('warehouse.index')->with('success','Warehouse Added Successfully!');
    }

    public function destroy(Warehouse $warehouse)
    {
        Warehouse::where('id',$warehouse->id)->delete();
        return back();
    }
}
