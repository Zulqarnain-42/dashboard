<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use Illuminate\Support\Facades\File;
use App\Models\Slider;
use App\Models\Status;
use App\Models\Visibilty;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $collectionslider = Slider::get();
        return view('slider.index')->with(compact('collectionslider'));
    }

    public function create()
    {
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        return view('slider.form')->with(compact('collectionstatus','collectionvisibility'));
    }

    public function store(StoreSliderRequest $request)
    {
        $dbcheck = Slider::where([['heading', '=', $request->sliderheading],['text','=',$request->slidertext],['text2','=',$request->slidertext2],['slug','=',$request->sliderslug]])->first();

        if($dbcheck === null){
            $request->validate([
                'sliderslug' => 'required',
            ]);

            $slider = new Slider();
            $slider->slidercode = $this->generateUniqueCode();
            $slider->heading = $request->sliderheading;
            $slider->text = $request->slidertext;
            $slider->text2 = $request->slidertext2;
            $slider->slug = $request->sliderslug;
            $slider->status = $request->status;
            $slider->visibility = $request->visibility;

            if($request->sliderUploadFilePond){
                $newfilename = Str::after($request->sliderUploadFilePond,'tmp/');
                Storage::disk('public')->move($request->sliderUploadFilePond,"images/slider/$newfilename");
                $slider->image = "storage/images/slider/$newfilename";
            }

            $slider->save();
        }else{
            return redirect()->route('slider.index')->with('alert','Slider Already Exist!');
        }

        return redirect()->route('slider.index')->with('success','Slider Added Successfully!');
    }

    public function edit(Slider $slider)
    {
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        return view('slider.form')->with(compact('slider','collectionstatus','collectionvisibility'));
    }

    public function update(UpdateSliderRequest $request,Slider $slider)
    {
        $request->validate([
            'sliderslug' => 'required',
        ]);

        if($slider->slidercode === null){
            $slider->slidercode = $this->generateUniqueCode();
        }

        $slider->heading = $request->sliderheading;
        $slider->text = $request->slidertext;
        $slider->text2 = $request->slidertext2;
        $slider->slug = $request->sliderslug;
        $slider->status = $request->status;
        $slider->visibility = $request->visibility;

        if($request->sliderUploadFilePond){
            $newfilename = Str::after($request->sliderUploadFilePond,'tmp/');
            Storage::disk('public')->move($request->sliderUploadFilePond,"images/slider/$newfilename");
            $slider->image = "storage/images/slider/$newfilename";
        }

        $slider->update();

        return redirect()->route('slider.index');
    }

    public function uploadslider(Request $request)
    {
        if($request->sliderUploadFilePond){
            $path = $request->file('sliderUploadFilePond')->store('tmp','public');
        }

        return $path;
    }

    public function generateUniqueCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 8;

        $code = '';

        while (strlen($code) < 8) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Slider::where('slidercode', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }

    public function destroy(Slider $slider)
    {
        Slider::where('id',$slider->id)->delete();
        return back();
    }
}
