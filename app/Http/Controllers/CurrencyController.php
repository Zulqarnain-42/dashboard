<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Currency\StoreCurrencyRequest;
use App\Http\Requests\Currency\UpdateCurrencyRequest;
use App\Models\SupportedCurrency;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(SupportedCurrency::get())->tojson();
        }
        return view('currency.index');
    }

    public function store(StoreCurrencyRequest $request)
    {
        $this->validate($request, [
            'currencyname' => 'required',
            'currencysymbol' => 'required',
        ]);

        $supportedcurreny = new SupportedCurrency();
        $supportedcurreny->name = $request->currencyname;
        $supportedcurreny->symbol = $request->currencysymbol;
        if ($request->isfeatured != null) {
            $supportedcurreny->default = $request->isfeatured;
        } else {
            $supportedcurreny->default = false;
        }

        $supportedcurreny->save();
        return response()->json([
            'success' => 'Record Added Successfully!'
        ]);
    }

    public function edit(SupportedCurrency $currency)
    {
        return response()->json([
            'data' => $currency
        ]);
    }

    public function update(UpdateCurrencyRequest $request,SupportedCurrency $currency)
    {
        $this->validate($request, [
            'currencyname' => 'required',
            'currencysymbol' => 'required',
        ]);

        $currency->name = $request->currencyname;
        $currency->symbol = $request->currencysymbol;

        if ($request->isfeatured != null) {
            $currency->default = $request->isfeatured;
        } else {
            $currency->default = false;
        }

        $currency->update();
        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);
    }

    public function destroy(SupportedCurrency $currency)
    {
        SupportedCurrency::where('id', $currency->id)->delete();
        return response()->json([
            'success' => 'Record Deleted Successfully!'
        ]);
    }

    public function changecurrencystatus(Request $request)
    {
        if($request !== null){
            $currencydata = SupportedCurrency::where('id',$request->currencyid)->first();
            if($currencydata->status == true){
                SupportedCurrency::where('id',$request->currencyid)->update(['status'=>false]);
            }else{
                SupportedCurrency::where('id',$request->currencyid)->update(['status'=>true]);
            }
        }

        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);
    }

}
