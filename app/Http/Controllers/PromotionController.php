<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Http\Requests\Promotion\StorePromotionRequest;
use App\Http\Requests\Promotion\UpdatePromotionRequest;
use App\Models\PromotionProducts;
use App\Models\Status;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Promotion::all())->tojson();
        }
        return view('promotions.index');
    }

    public function create()
    {
        $collectionstatus = Status::get();
        return view('promotions.form')->with(compact('collectionstatus'));
    }

    public function store(StorePromotionRequest $request)
    {
        dd($request);

        $request->validate([
            'title'=>'required',
            'startdate'=>'required',
            'enddate'=>'required'
        ]);

        $newpromotion = new Promotion();
        $newpromotion->promotioncode = $this->generateUniqueCode();
        $newpromotion->title = $request->title;
        $newpromotion->start_date = $request->start_date;
        $newpromotion->end_date = $request->end_date;
        $newpromotion->save();

        if($request->promotionproducts){
            $newpromotionproducts = new PromotionProducts();
            foreach($request->promotionproducts as $promproducts){
                $newpromotionproducts->promotionid = $newpromotion->id;
                $newpromotionproducts->productid = $promproducts->productid;
                $newpromotionproducts->newprice = $promproducts->newprice;
                $newpromotionproducts->save();
            }
        }

        return redirect()->view('promotions.index');
    }

    public function edit(Promotion $promotion)
    {
        return view('promotions.form')->with(compact('promotion'));
    }

    public function update(UpdatePromotionRequest $request,Promotion $promotion)
    {
        dd($request);

        $request->validate([
            'title'=>'required',
            'startdate'=>'required',
            'enddate'=>'required'
        ]);

        if(!$promotion->promotioncode){
            $promotion->promotioncode = $this->generateUniqueCode();
        }
        $promotion->title = $request->title;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->update();

        if($request->promotionproducts)

        return redirect()->view('promotions.index');
    }

    public function generateUniqueCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 4;
        $code = '';
        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
        if (Promotion::where('promotioncode', $code)->exists()) {
            $this->generateUniqueCode();
        }
        return $code;
    }
}
