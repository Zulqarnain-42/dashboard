<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Status;
use App\Models\Visibilty;


class SupplierController extends Controller
{
    public function index()
    {
        $collectionsupplier = Supplier::get();
        $collectionstatus = Status::get();
        return view('supplier.index')->with(compact('collectionsupplier','collectionstatus'));
    }

    public function store(StoreSupplierRequest $request)
    {
        $dbcheck = Supplier::where([['firstname', '=', $request->firstname],
                                    ['lastname', '=', $request->lastname],
                                    ['address', '=', $request->address],
                                    ['city', '=', $request->city],
                                    ['region', '=', $request->region],
                                    ['postalcode', '=', $request->postalcode],
                                    ['country', '=', $request->country],
                                    ['mobile', '=', $request->mobile],
                                    ['email', '=', $request->email]])->first();

        if($dbcheck === null){
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'mobile' => 'required',
                'email' => 'required',
            ]);

            $newsupplier =new Supplier();
            $newsupplier->firstname = $request->firstname;
            $newsupplier->lastname = $request->lastname;
            $newsupplier->address = $request->address;
            $newsupplier->city = $request->city;
            $newsupplier->region = $request->region;
            $newsupplier->postalcode = $request->postalcode;
            $newsupplier->country = $request->country;
            $newsupplier->mobile = $request->mobile;
            $newsupplier->email = $request->email;
            $newsupplier->status = $request->status;

            $newsupplier->save();

        }else{
            return redirect()->route('supplier.index')->with('alert','Supplier Already Exist!');
        }

        return redirect()->route('supplier.index')->with('success','Supplier Added Successfully!');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.form')->with(compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request,Supplier $supplier)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        $supplier->firstname;
        $supplier->lastname;
        $supplier->address;
        $supplier->city;
        $supplier->region;
        $supplier->postalcode;
        $supplier->country;
        $supplier->mobile;
        $supplier->email;

        $supplier->update();

        return redirect()->route('supplier.index')->with('success','Supplier Updated Successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        Supplier::where('id',$supplier->id)->delete();
        return back();
    }
}
