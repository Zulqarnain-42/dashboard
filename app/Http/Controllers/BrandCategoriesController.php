<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandCategory;
use App\Models\Status;
use App\Models\Visibilty;
use App\Http\Requests\BrandCategory\StoreBrandCategoryRequest;
use App\Http\Requests\BrandCategory\UpdateBrandCategoryRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandCategoriesController extends Controller
{
    public function index()
    {
        $collectionbrandcategories = BrandCategory::with('brand')->get();
        return view('brandcategory.index')->with(compact('collectionbrandcategories'));
    }

    public function create()
    {
        $collectionmainbrandcategory = BrandCategory::with('ancestors')->where([['status', true], ['visibility', true]])->get();
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        $collectionbrand = Brand::where([['status',true],['visibility',true]])->get();
        return view('brandcategory.form')->with(compact('collectionmainbrandcategory','collectionstatus','collectionvisibility','collectionbrand'));
    }

    public function store(StoreBrandCategoryRequest $request)
    {
        $dbcheck = BrandCategory::where([['title', '=', $request->title],['parent_id',$request->maincategory]])->first();

        if($dbcheck === null){

            $request->validate([
                'title' => 'required',
                'status' => 'required',
                'visibility' => 'required',
            ]);
            $brandcategory = new BrandCategory();

            if($request->CategoryImageUploadFilePond){
                $newfilename = Str::after($request->CategoryImageUploadFilePond,'tmp/');
                Storage::disk('public')->move($request->CategoryImageUploadFilePond,"images/categories/$newfilename");
                $brandcategory->image = "storage/images/categories/$newfilename";
            }

            $brandcategory->categorycode = $this->generateUniqueCode();
            $brandcategory->title = $request->title;
            $brandcategory->brandid = $request->brandid;
            $brandcategory->description = $request->description;
            $brandcategory->metatitle = $request->metatitle;
            $brandcategory->metakeywords = $request->metakeywords;
            $brandcategory->metadescription = $request->metadescription;
            $brandcategory->status = $request->status;
            $brandcategory->visibility = $request->visibility;

            if($request->CategorySliderUploadFilePond){
                $newfilename = Str::after($request->CategorySliderUploadFilePond,'tmp/');
                Storage::disk('public')->move($request->CategorySliderUploadFilePond,"images/categories/banners/$newfilename");
                $brandcategory->slider = "storage/images/categories/banners/$newfilename";
            }

            if ($request->maincategory && $request->maincategory != 'none') {
                $node = BrandCategory::find($request->maincategory);
                $node->appendNode($brandcategory);
            }

            $brandcategory->save();

        }else{
            return redirect()->route('brandcategory.index')->with('alert','Category Already Exist!');
        }

        return redirect()->route('brandcategory.index')->with('success','Category Added Successfully!');
    }

    public function edit(BrandCategory $brandCategory)
    {
        $collectionmainbrandcategory = BrandCategory::with('ancestors')->where([['status', true], ['visibility', true]])->get();
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        return view('brandcategory.form')->with(compact('brandCategory', 'collectionmainbrandcategory','collectionstatus','collectionvisibility'));
    }

    public function update(UpdateBrandCategoryRequest $request, BrandCategory $brandCategory)
    {

        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);

        if($request->CategoryImageUploadFilePond){
            $newfilename = Str::after($request->CategoryImageUploadFilePond,'tmp/');
            Storage::disk('public')->move($request->CategoryImageUploadFilePond,"images/categories/$newfilename");
            $brandCategory->image = "storage/images/categories/$newfilename";
        }

        if($brandCategory->categorycode === null){
            $brandCategory->categorycode = $this->generateUniqueCode();
        }

        $brandCategory->title = $request->title;
        $brandCategory->description = $request->description;
        $brandCategory->metatitle = $request->metatitle;
        $brandCategory->brandid = $request->brandid;
        $brandCategory->metakeywords = $request->metakeywords;
        $brandCategory->metadescription = $request->metadescription;
        $brandCategory->status = $request->status;
        $brandCategory->visibility = $request->visibility;

        if($request->CategorySliderUploadFilePond){
            $newfilename = Str::after($request->CategorySliderUploadFilePond,'tmp/');
            Storage::disk('public')->move($request->CategorySliderUploadFilePond,"images/categories/banners/$newfilename");
            $brandCategory->slider = "storage/images/categories/banners/$newfilename";
        }

        if ($request->maincategory && $request->maincategory != 'none') {
            $node = BrandCategory::find($request->maincategory);
            $node->appendNode($brandCategory);
        }

        $brandCategory->update();

        return redirect()->route('brandcategory.index')->with('success','Çategory Updated Successfully!');
    }

    public function uploadcategoryslider(Request $request)
    {
        if($request->CategorySliderUploadFilePond){
            $path = $request->file('CategorySliderUploadFilePond')->store('tmp','public');
        }

        return $path;
    }

    public function uploadcategoryimage(Request $request)
    {

         if($request->CategoryImageUploadFilePond){
            $path = $request->file('CategoryImageUploadFilePond')->store('tmp','public');
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

        if (BrandCategory::where('categorycode', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }

    public function destroy(BrandCategory $brandcategory)
    {

        $childcategory = BrandCategory::where('parent_id',$brandcategory->id)->get();
        foreach($childcategory as $child){
            $child->visibility = false;
            $child->update();
        }
        BrandCategory::where('id',$brandcategory->id)->delete();
        return back();
    }
}
