<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MainSlider\StoreMainSliderRequest;
use App\Http\Requests\MainSlider\UpdateMainSliderRequest;
use Illuminate\Support\Facades\File;
use App\Models\MainSlider;

class MainSliderController extends Controller
{
    public function index()
    {
        $collectionmainslider = MainSlider::get();
        return view('mainslider.index')->with(compact('collectionmainslider'));
    }

    public function create()
    {
        return view('mainslider.form');
    }

    public function store(StoreMainSliderRequest $request)
    {
        dd($request);
    }

    public function edit(MainSlider $mainslider)
    {
        return view('mainslider.form')->with(compact('mainslider'));
    }

    public function update(UpdateMainSliderRequest $request,MainSlider $mainslider)
    {
        dd($request);
    }

    public function uploadmainslider(Request $request)
    {
        $file = $request->file('file');
        if ($request->hasFile('file')) {
            $destination_path = 'public/images/mainslider';
            $image = $request->file('file');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('file')->storeAs($destination_path, $image_name);
        }
        return response()->json([
            'name' => $image_name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function removemainslider(Request $request)
    {
        $destination = 'storage/images/mainslider/' . trim($request->name);
        if (File::exists($destination)) {
            File::delete($destination);
        }
    }
}
