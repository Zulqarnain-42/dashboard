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
        $request->validate([
            'promotiontitle'=>'required',
            'startdate'=>'required',
            'enddate'=>'required'
        ]);

        $newpromotion = new Promotion();
        $newpromotion->promotioncode = $this->generateUniqueCode();
        $newpromotion->title = $request->promotiontitle;
        $newpromotion->start_date = $request->startdate;
        $newpromotion->end_date = $request->enddate;
        $newpromotion->status = $request->status;
        $newpromotion->save();

        $newpromotionproducts = new PromotionProducts();
        if($request->productid){
            for($i = 0 ; ($request->productid) < $i; $i++){
                dd($request->productid[$i],$request->newprice[$i],$request->quantity[$i]);
                $newpromotionproducts->promotionid = $newpromotion->id;
                $newpromotionproducts->productid = $request->productid[$i];
                $newpromotionproducts->newprice = $request->newprice[$i];
                $newpromotionproducts->quantity = $request->quantity[$i];
                $newpromotionproducts->save();
            }
        }

        return view('promotions.index');
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
        $codeLength = 8;
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
