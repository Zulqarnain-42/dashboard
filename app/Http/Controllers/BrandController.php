<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $collectionbrand = Brand::get();
        return view('brands.index')->with(compact('collectionbrand'));
    }

    public function create()
    {
        return view('brands.form');
    }

    public function store(StoreBrandRequest $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);

        $brand = new Brand();
        $brand->brandcode = $this->unique_code(9);
        $brand->title = $request->title;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->visibility = $request->visibility;
        $brand->metatitle = $request->metatitle;
        $brand->metakeywords = $request->metakeyword;
        $brand->metadescription = $request->metadescription;
        $brand->image = $request->brandfiles;
        $brand->slug = Str::slug($request->title, '-');
        $brand->save();

        return redirect()->route('brand.index');
    }

    public function edit(Brand $brand)
    {
        return view('brands.form')->with(compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);

        if($request->brandfiles){
            $destination = 'storage/images/brands/' . trim($brand->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }

        $brand->title = $request->title;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->visibility = $request->visibility;
        $brand->metatitle = $request->metatitle;
        $brand->metakeywords = $request->metakeyword;
        $brand->metadescription = $request->metadescription;
        if($request->brandfiles){
            $brand->image = $request->brandfiles;
        }
        $brand->update();

        return redirect()->route('brand.index');
    }

    public function uploadbrand(Request $request)
    {
        $file = $request->file('file');
        if ($request->hasFile('file')) {
            $destination_path = 'public/images/brands';
            $image = $request->file('file');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('file')->storeAs($destination_path, $image_name);
        }
        return response()->json([
            'name' => $image_name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function removebrand(Request $request)
    {
        $destination = 'storage/images/brands/' . trim($request->name);
        if (File::exists($destination)) {
            File::delete($destination);
        }
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
