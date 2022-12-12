<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Currency\StoreCurrencyRequest;
use App\Http\Requests\Currency\UpdateCurrencyRequest;
use App\Models\SupportedCurrency;

class CurrencyController extends Controller
{
    public function index()
    {
        $collectionsupportedcurreny = SupportedCurrency::get();
        return view('currency.index')->with(compact('collectionsupportedcurreny'));
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
        return redirect()->route('currency.index');
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

        $currency->save();

        return redirect()->route('currency.index');
    }

    public function destroy(SupportedCurrency $currency)
    {
        SupportedCurrency::where('id', $currency->id)->delete();
        return back();
    }

}
