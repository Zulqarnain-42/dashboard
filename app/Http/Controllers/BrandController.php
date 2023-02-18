<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\Visibilty;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Brand::all())->tojson();
        }
        return view('brands.index');
    }

    public function create()
    {
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        return view('brands.form')->with(compact('collectionstatus','collectionvisibility'));
    }

    public function store(StoreBrandRequest $request)
    {
        $dbcheck = Brand::where([['title', '=', $request->title]])->first();

        if($dbcheck === null){
            $request->validate([
                'title' => 'required',
                'status' => 'required',
            ]);

            $brand = new Brand();
            $brand->brandcode = $this->generateUniqueCode();
            $brand->title = $request->title;
            $brand->description = $request->description;
            $brand->status = $request->status;
            $brand->visibility = $request->visibility;
            $brand->metatitle = $request->metatitle;
            $brand->metakeywords = $request->metakeyword;
            $brand->metadescription = $request->metadescription;

            if($request->BrandUploadFilePond){
                $newfilename = Str::after($request->BrandUploadFilePond,'tmp/');
                Storage::disk('public')->move($request->BrandUploadFilePond,"images/brands/$newfilename");
                $brand->image = "storage/images/brands/$newfilename";
            }

            $brand->save();
        }
        else{
            return redirect()->route('brand.index')->with('alert','Brand Already Exist!');
        }

        return redirect()->route('brand.index')->with('success','Brand Added Successfully!');
    }

    public function edit(Brand $brand)
    {
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        return view('brands.form')->with(compact('brand','collectionstatus','collectionvisibility'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);

        if($brand->brandcode === null){
            $brand->brandcode = $this->generateUniqueCode();
        }

        $brand->title = $request->title;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->visibility = $request->visibility;
        $brand->metatitle = $request->metatitle;
        $brand->metakeywords = $request->metakeyword;
        $brand->metadescription = $request->metadescription;

        if($request->BrandUploadFilePond){
            $newfilename = Str::after($request->BrandUploadFilePond,'tmp/');
            Storage::disk('public')->move($request->BrandUploadFilePond,"images/brands/$newfilename");
            $brand->image = "storage/images/brands/$newfilename";
        }

        $brand->update();

        return redirect()->route('brand.index')->with('success','Brand Updated Successfully!');
    }

    public function uploadbrand(Request $request)
    {
        if($request->BrandUploadFilePond){
            $path = $request->file('BrandUploadFilePond')->store('tmp','public');
        }

        return $path;
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

        if (Brand::where('brandcode', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }

    public function destroy(Brand $brand)
    {
        Brand::where('id',$brand->id)->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function changebrandstatus(Request $request)
    {
        if($request !== null){
            $branddata = Brand::where('id',$request->brandid)->first();
            if($branddata->status == true){
                Brand::where('id',$request->brandid)->update(['status'=>false]);
            }else{
                Brand::where('id',$request->brandid)->update(['status'=>true]);
            }
        }

        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);
    }


    public function makebrandfeatured(Request $request)
    {
        if($request !== null){
            $branddata = Brand::where('id',$request->brandid)->first();
            if($branddata->isfeatured == true){
                Brand::where('id',$request->brandid)->update(['isfeatured'=>false]);
            }else{
                Brand::where('id',$request->brandid)->update(['isfeatured'=>true]);
            }
        }

        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);
    }
}
