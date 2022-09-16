<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use Illuminate\Support\Facades\File;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $collectionslider = Slider::where([['status',true],['visibility',true]])->get();
        return view('slider.index')->with(compact('collectionslider'));
    }

    public function create()
    {
        return view('slider.form');
    }

    public function store(StoreSliderRequest $request)
    {
        $request->validate([
            'sliderslug' => 'required',
            'status' => 'required',
            'visibility' => 'required'
        ]);

        $slider = new Slider();
        $slider->slidercode = $this->unique_code(9);
        $slider->heading = $request->sliderheading;
        $slider->text = $request->slidertext;
        $slider->text2 = $request->slidertext2;
        $slider->slug = $request->sliderslug;
        $slider->status = $request->status;
        $slider->visibility = $request->visibility;
        $slider->image = $request->sliderfiles;
        $slider->save();

        return redirect()->route('slider.index')->with('success','Slider Added Successfully!');
    }

    public function edit(Slider $slider)
    {
        return view('slider.form')->with(compact('slider'));
    }

    public function update(UpdateSliderRequest $request,Slider $slider)
    {
        $request->validate([
            'sliderslug' => 'required',
            'status' => 'required',
            'visibility' => 'required'
        ]);

        if($request->sliderfiles){
            $destination = 'storage/images/slider/' . trim($slider->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }

        $slider->heading = $request->sliderheading;
        $slider->text = $request->slidertext;
        $slider->text2 = $request->slidertext2;
        $slider->slug = $request->sliderslug;
        $slider->status = $request->status;
        $slider->visibility = $request->visibility;
        if($request->sliderfiles){
            $slider->image = $request->sliderfiles;
        }
        $slider->update();

        return redirect()->route('slider.index');
    }

    public function uploadslider(Request $request)
    {
        $file = $request->file('file');
        if ($request->hasFile('file')) {
            $destination_path = 'public/images/slider';
            $image = $request->file('file');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('file')->storeAs($destination_path, $image_name);
        }
        return response()->json([
            'name' => $image_name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function removeslider(Request $request)
    {
        $destination = 'storage/images/slider/' . trim($request->name);
        if (File::exists($destination)) {
            File::delete($destination);
        }
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
