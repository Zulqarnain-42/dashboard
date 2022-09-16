<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        return view('categories.form')->with(compact('collectionmaincategory'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);
        $category = new Category();

        if ($request->hasFile('categoryimage')) {
            $destination_path = 'public/images/categories';
            $image = $request->file('categoryimage');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('categoryimage')->storeAs($destination_path, $image_name);
            $category->image = $image_name;
        }

        $category->categorycode = $this->unique_code(9);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->metatitle = $request->metatitle;
        $category->metakeywords = $request->metakeywords;
        $category->metadescription = $request->metadescription;
        $category->status = $request->status;
        $category->visibility = $request->visibility;
        $category->slider = $request->categorysliderfiles;
        $category->slug = Str::slug($request->title, '-');

        if ($request->maincategory && $request->maincategory != 'none') {
            $node = Category::find($request->maincategory);
            $node->appendNode($category);
        }

        $category->save();

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $collectionmaincategory = Category::with('ancestors')->where([['status', true], ['visibility', true]])->get();
        return view('categories.form')->with(compact('category', 'collectionmaincategory'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);

        if ($request->hasFile('categoryimage')) {
            $destination = 'storage/images/categories/' . $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $destination_path = 'public/images/categories';
            $image = $request->file('categoryimage');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('categoryimage')->storeAs($destination_path, $image_name);
            $category->image = $image_name;
        }

        if ($request->categorysliderfiles) {
            $destination = 'storage/images/category/banner/' . trim($category->slider);
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }

        $category->title = $request->title;
        $category->description = $request->description;
        $category->metatitle = $request->metatitle;
        $category->metakeywords = $request->metakeywords;
        $category->metadescription = $request->metadescription;
        $category->status = $request->status;
        $category->visibility = $request->visibility;
        if ($request->categorysliderfiles) {
            $category->slider = $request->categorysliderfiles;
        }
        $category->update();

        return redirect()->route('categories.index');
    }

    public function uploadcategoryslider(Request $request)
    {
        $file = $request->file('file');
        if ($request->hasFile('file')) {
            $destination_path = 'public/images/category/banner';
            $image = $request->file('file');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('file')->storeAs($destination_path, $image_name);
        }
        return response()->json([
            'name' => $image_name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function removecategoryslider(Request $request)
    {
        $destination = 'storage/images/category/banner/' . trim($request->name);
        if (File::exists($destination)) {
            File::delete($destination);
        }
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function destroy(Request $request)
    {
        dd($request);
    }
}
