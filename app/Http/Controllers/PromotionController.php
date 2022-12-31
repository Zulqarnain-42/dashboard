<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Http\Requests\Promotion\StorePromotionRequest;

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
        return view('promotions.form');
    }

    public function store(StorePromotionRequest $request)
    {
        # code...
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
