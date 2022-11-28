<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\Visibilty;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function index()
    {
        $collectioncategories = Category::get();
        return view('categories.index')->with(compact('collectioncategories'));
    }

    public function create()
    {
        $collectionmaincategory = Category::with('ancestors')->where([['status', true], ['visibility', true]])->get();
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        return view('categories.form')->with(compact('collectionmaincategory','collectionstatus','collectionvisibility'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $dbcheck = Category::where([['title', '=', $request->title],['parent_id',$request->maincategory]])->first();

        if($dbcheck === null){

            $request->validate([
                'title' => 'required',
                'status' => 'required',
                'visibility' => 'required',
            ]);
            $category = new Category();

            if($request->CategoryImageUploadFilePond){
                $newfilename = Str::after($request->CategoryImageUploadFilePond,'tmp/');
                Storage::disk('public')->move($request->CategoryImageUploadFilePond,"images/categories/$newfilename");
                $category->image = "storage/images/categories/$newfilename";
            }

            $category->categorycode = $this->generateUniqueCode();
            $category->title = $request->title;
            $category->description = $request->description;
            $category->metatitle = $request->metatitle;
            $category->metakeywords = $request->metakeywords;
            $category->metadescription = $request->metadescription;
            $category->status = $request->status;
            $category->visibility = $request->visibility;

            if($request->CategorySliderUploadFilePond){
                $newfilename = Str::after($request->CategorySliderUploadFilePond,'tmp/');
                Storage::disk('public')->move($request->CategorySliderUploadFilePond,"images/categories/banners/$newfilename");
                $category->slider = "storage/images/categories/banners/$newfilename";
            }

            if ($request->maincategory && $request->maincategory != 'none') {
                $node = Category::find($request->maincategory);
                $node->appendNode($category);
            }

            $category->save();
        }else{
            return redirect()->route('categories.index')->with('alert','Category Already Exist!');
        }

        return redirect()->route('categories.index')->with('success','Category Added Successfully!');
    }

    public function edit(Category $category)
    {
        $collectionmaincategory = Category::with('ancestors')->where([['status', true], ['visibility', true]])->get();
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        return view('categories.form')->with(compact('category', 'collectionmaincategory','collectionstatus','collectionvisibility'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);

        if($request->CategoryImageUploadFilePond){
            $newfilename = Str::after($request->CategoryImageUploadFilePond,'tmp/');
            Storage::disk('public')->move($request->CategoryImageUploadFilePond,"images/categories/$newfilename");
            $category->image = "storage/images/categories/$newfilename";
        }

        if($category->categorycode === null){
            $category->categorycode = $this->generateUniqueCode();
        }

        $category->title = $request->title;
        $category->description = $request->description;
        $category->metatitle = $request->metatitle;
        $category->metakeywords = $request->metakeywords;
        $category->metadescription = $request->metadescription;
        $category->status = $request->status;
        $category->visibility = $request->visibility;

        if($request->CategorySliderUploadFilePond){
            $newfilename = Str::after($request->CategorySliderUploadFilePond,'tmp/');
            Storage::disk('public')->move($request->CategorySliderUploadFilePond,"images/categories/banners/$newfilename");
            $category->slider = "storage/images/categories/banners/$newfilename";
        }

        if ($request->maincategory && $request->maincategory != 'none') {
            $node = Category::find($request->maincategory);
            $node->appendNode($category);
        }

        $category->update();

        return redirect()->route('categories.index')->with('success','Çategory Updated Successfully!');
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

        if (Category::where('categorycode', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }

    public function destroy(Category $category)
    {

        $childcategory = Category::where('parent_id',$category->id)->get();
        foreach($childcategory as $child){
            $child->visibility = false;
            $child->update();
        }
        Category::where('id',$category->id)->delete();
        return back();
    }
}
