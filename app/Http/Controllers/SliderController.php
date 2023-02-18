<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use Illuminate\Support\Facades\File;
use App\Models\Slider;
use App\Models\Status;
use App\Models\Visibilty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Slider::all())->tojson();
        }
        return view('slider.index');
    }

    public function create()
    {
        $collectionstatus = Status::get();
        return view('slider.form')->with(compact('collectionstatus'));
    }

    public function store(StoreSliderRequest $request)
    {
        $dbcheck = Slider::where([['paragraphone', '=', $request->paragraphone],
                                ['paragraphtwo','=',$request->paragraphtwo],
                                ['paragraphthree','=',$request->paragraphthree],
                                ['paragraphfour','=',$request->paragrapfour],
                                ['slug','=',$request->sliderslug]])->first();

        if($dbcheck === null){
            $request->validate([
                'sliderslug' => 'required',
            ]);

            $slider = new Slider();
            $slider->paragraphone = $request->paragraphone;
            $slider->paragraphtwo = $request->paragraphtwo;
            $slider->paragraphthree = $request->paragraphthree;
            $slider->paragraphfour = $request->paragrapfour;
            $slider->slug = $request->sliderslug;
            $slider->status = $request->status;
            $slider->buttontext = $request->buttontext;
            $slider->addedby = Auth::user()->id;

            if($request->sliderUploadFilePondOne){
                $newfilename = Str::after($request->sliderUploadFilePondOne,'tmp/');
                Storage::disk('public')->move($request->sliderUploadFilePondOne,"images/slider/$newfilename");
                $slider->imageone = "storage/images/slider/$newfilename";
            }

            if($request->sliderUploadFilePondTwo){
                $newfilename = Str::after($request->sliderUploadFilePondTwo,'tmp/');
                Storage::disk('public')->move($request->sliderUploadFilePondTwo,"images/slider/$newfilename");
                $slider->imagetwo = "storage/images/slider/$newfilename";
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
        return view('slider.form')->with(compact('slider','collectionstatus'));
    }

    public function update(UpdateSliderRequest $request,Slider $slider)
    {
        $request->validate([
            'sliderslug' => 'required',
        ]);

        $slider->paragraphone = $request->paragraphone;
        $slider->paragraphtwo = $request->paragraphtwo;
        $slider->paragraphthree = $request->paragraphthree;
        $slider->slug = $request->sliderslug;
        $slider->status = $request->status;
        $slider->buttontext = $request->buttontext;
        $slider->addedby = Auth::user()->id;

        if($request->sliderUploadFilePondOne){
            $newfilename = Str::after($request->sliderUploadFilePondOne,'tmp/');
            Storage::disk('public')->move($request->sliderUploadFilePondOne,"images/slider/$newfilename");
            $slider->imageone = "storage/images/slider/$newfilename";
        }

        if($request->sliderUploadFilePondTwo){
            $newfilename = Str::after($request->sliderUploadFilePondTwo,'tmp/');
            Storage::disk('public')->move($request->sliderUploadFilePondTwo,"images/slider/$newfilename");
            $slider->imagetwo = "storage/images/slider/$newfilename";
        }

        $slider->update();

        return redirect()->route('slider.index');
    }

    public function uploadsliderone(Request $request)
    {
        if($request->sliderUploadFilePondOne){
            $path = $request->file('sliderUploadFilePondOne')->store('tmp','public');
        }

        return $path;
    }

    public function uploadslidertwo(Request $request)
    {
        if($request->sliderUploadFilePondTwo){
            $path = $request->file('sliderUploadFilePondTwo')->store('tmp','public');
        }

        return $path;
    }


    public function destroy(Slider $slider)
    {
        Slider::where('id',$slider->id)->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function changesliderstatus(Request $request)
    {
        if($request !== null){
            $sliderdata = Slider::where('id',$request->sliderid)->first();
            if($sliderdata->status == true){
                Slider::where('id',$request->sliderid)->update(['status'=>false]);
            }else{
                Slider::where('id',$request->sliderid)->update(['status'=>true]);
            }
        }

        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);

    }
}
