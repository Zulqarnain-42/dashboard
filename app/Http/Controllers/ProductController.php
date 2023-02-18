<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\CategoryProduct;
use App\Models\ProductTags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\Visibilty;
use App\Models\Availability;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Product::all())->tojson();
        }
        return view('products.index');
    }

    public function create()
    {
        $collectioncategory[] = array();
        $collectionbrand = Brand::where([['status', true]])->get();
        $collectioncategory = Category::where([['status', true]])->get();
        $categorytree =  Category::where([['status',true]])->get()->toTree();
        $collectionproducts = Product::where([['status', true]])->get();
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        $collectionavailability = Availability::where([['status', true]])->get();
        $selectedproducttags = [];

        return view('products.form')->with(compact('collectionbrand',
                                                    'collectioncategory',
                                                    'collectionproducts',
                                                    'collectionstatus',
                                                    'collectionvisibility',
                                                    'collectionavailability',
                                                    'selectedproducttags'));
    }

    public function store(StoreProductRequest $request)
    {
        $dbcheck = Product::where([['title', '=', $request->producttitle],
                                    ['mfr','=',$request->mfrmodel],
                                    ['brandid','=',$request->brand]])->first();

        if($dbcheck === null){
            $request->validate([
                'producttitle' => 'required',
                'mfrmodel' => 'required',
                'saleprice' => 'required',
                'status' => 'required',
                'productcategories' => 'required',
            ]);

            $brand = Brand::findOrFail($request->brand);
            $product = new Product();

            if($request->ProductsThumbnailFilePond){
                $newfilename = Str::after($request->ProductsThumbnailFilePond,'tmp/');
                Storage::disk('public')->move($request->ProductsThumbnailFilePond,"images/thumbnail/$newfilename");
                $product->thumbnail = "storage/images/thumbnail/$newfilename";
            }

            $product->productcode = $this->generateUniqueCode().''.$request->mfrmodel;
            $product->title = $request->producttitle;
            $product->longdescription = $request->longdescription;
            $product->shortdescription = $request->shortdes;
            $product->mfr = strtoupper($request->mfrmodel);
            $product->sku = strtoupper($request->sku);
            $product->upc = $request->upc;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->weight = $request->weight;
            $product->price = $request->saleprice;
            $product->status = $request->status;
            $product->visibility = $request->visibility;
            $product->inthebox = $request->inthebox;
            $product->specifications = $request->specifications;
            $product->metatitle = $request->metatitle;
            $product->metakeywords = $request->metakeywords;
            $product->metadescription = $request->metadescription;
            $product->brandid = $brand->id;
            $product->retailprice = $request->retailprice;
            $product->availabilityid = $request->availability;
            $product->addedby = Auth()->user()->id;
            $product->save();

            if ($request->ProductsUploadFilePond) {
                foreach ($request->ProductsUploadFilePond as $productimage) {
                    $newfilename = Str::after($productimage,'tmp/');
                    Storage::disk('public')->move($productimage,"images/products/$newfilename");
                    $productimg[] = $product->productimages()->create([
                        'productid' => $product->id,
                        'images' => "storage/images/products/$newfilename",
                    ]);
                }
            }

            $product->history()->create([
                'product_id' => $product->id,
                'description' => "product created",
                'userid' => Auth()->user()->id
            ]);

            if ($request->producttages) {
                $tagsproduct = explode(',',$request->producttages);
                foreach ($tagsproduct as $tags) {
                    $product->producttags()->create([
                        'productid' => $product->id,
                        'tags' => $tags,
                    ]);
                }
            }

            if ($request->productcategories) {
                $productcategories = new CategoryProduct();
                foreach ($request->productcategories as $categories) {
                    $category = Category::findOrFail($categories);
                    $productcategories->create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                    ]);
                }
            }

            return redirect()->route('product.index')->with('success','Product Added Successfully!');
        }
        else
        {
            return redirect()->route('product.index')->with('alert','Product Already Exist!');
        }
    }

    public function edit(Product $product)
    {
        $collectionbrand = Brand::where([['status', true]])->get();
        $collectioncategory = Category::where([['status', true]])->get();
        $collectionproducts = Product::where([['status', true]])->get();
        $selectedproducttags = $product::find($product->id)->producttags;
        $selectedproductcategories = CategoryProduct::where('product_id', $product->id)->get();
        $productimages = $product::find($product->id)->productimages;
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        $collectionavailability = Availability::where([['status', true]])->get();

        return view('products.form')->with(compact(
            'product',
            'collectionbrand',
            'collectioncategory',
            'collectionproducts',
            'selectedproducttags',
            'selectedproductcategories',
            'productimages',
            'collectionstatus',
            'collectionvisibility',
            'collectionavailability'
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {

        $request->validate([
            'producttitle' => 'required',
            'mfrmodel' => 'required',
            'saleprice' => 'required',
            'status' => 'required',
        ]);

        if($request->ProductsThumbnailFilePond){
            $newfilename = Str::after($request->ProductsThumbnailFilePond,'tmp/');
            Storage::disk('public')->move($request->ProductsThumbnailFilePond,"images/thumbnail/$newfilename");
            $product->thumbnail = "storage/images/thumbnail/$newfilename";
        }

        if($request->saleprice !== $product->price){
            $product->history()->create([
                'product_id' => $product->id,
                'description' => "price updated",
                'userid' => Auth()->user()->id
            ]);
        }else{
            $product->history()->create([
                'product_id' => $product->id,
                'description' => "product updated",
                'userid' => Auth()->user()->id
            ]);
        }

        if($product->productcode === null){
            $product->productcode = $this->generateUniqueCode().''.$request->mfrmodel;
        }


        $product->title = $request->producttitle;
        $product->longdescription = $request->longdescription;
        $product->shortdescription = $request->shortdes;
        $product->mfr = strtoupper($request->mfrmodel);
        $product->sku = strtoupper($request->sku);
        $product->upc = $request->upc;
        $product->length = $request->length;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->weight = $request->weight;
        $product->price = $request->saleprice;
        $product->status = $request->status;
        $product->visibility = $request->visibility;
        $product->inthebox = $request->inthebox;
        $product->specifications = $request->specifications;
        $product->metatitle = $request->metatitle;
        $product->metakeywords = $request->metakeywords;
        $product->metadescription = $request->metadescription;
        $product->brandid = $request->brand;
        $product->retailprice = $request->retailprice;
        $product->availabilityid = $request->availability;

        $product->update();

        if ($request->ProductsUploadFilePond) {
            $productimages = $product->productimages()->delete();
            if($productimages > 1){
                foreach ($request->ProductsUploadFilePond as $productimage) {
                    $newfilename = Str::after($productimage,'tmp/');
                    Storage::disk('public')->move($productimage,"images/products/$newfilename");
                    $product->productimages()->create([
                        'productid' => $product->id,
                        'images' => "storage/images/products/$newfilename",
                    ]);
                }
            }
            else
            {
                foreach ($request->ProductsUploadFilePond as $productimage) {
                    $newfilename = Str::after($productimage,'tmp/');
                    Storage::disk('public')->move($productimage,"images/products/$newfilename");
                    $product->productimages()->create([
                        'productid' => $product->id,
                        'images' => "storage/images/products/$newfilename",
                    ]);
                }
            }
        }

        if ($request->producttages) {
            $prodtags = $product->producttags()->delete();
            if ($prodtags > 1) {
                $tagsproduct = explode(',',$request->producttages);
                foreach ($tagsproduct as $tags) {
                    $product->producttags()->create([
                        'productid' => $product->id,
                        'tags' => $tags,
                    ]);
                }
            }
            else if($request->producttages != null) {
                $tagsproduct = explode(',',$request->producttages);
                foreach ($tagsproduct as $tags) {
                    $product->producttags()->create([
                        'productid' => $product->id,
                        'tags' => $tags,
                    ]);
                }
            }
        }else{
            $findproducttags = $product::find($product->id)->producttags;
            if($findproducttags){
                $product->producttags()->delete();
            }
        }

        if ($request->productcategories) {
            $categories = CategoryProduct::where('product_id', $product->id)->delete();
            if ($categories > 1) {
                $productcategories = new CategoryProduct();
                foreach ($request->productcategories as $categories) {
                    $category = Category::findOrFail($categories);
                    $productcategories->create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                    ]);
                }
            } else {
                $productcategories = new CategoryProduct();
                foreach ($request->productcategories as $categories) {
                    $category = Category::findOrFail($categories);
                    $productcategories->create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                    ]);
                }
            }
        }else{
            $findproductcategories = CategoryProduct::where('product_id', $product->id)->get();
            if($findproductcategories){
                CategoryProduct::where('product_id', $product->id)->delete();
            }
        }
        return redirect()->route('product.index')->with('success','Product Updated Successfully!');
    }

    public function uploadproducts(Request $request)
    {
        if($request->ProductsUploadFilePond){
            $files = $request->file('ProductsUploadFilePond');
            foreach ($files as $file) {
                $path = $file->store('tmp','public');
            }
        }
        return $path;
    }

    public function uploadthumbnail(Request $request)
    {
        if($request->ProductsThumbnailFilePond){
            $path = $request->file('ProductsThumbnailFilePond')->store('tmp','public');
        }
        return $path;
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
        if (Product::where('productcode', $code)->exists()) {
            $this->generateUniqueCode();
        }
        return $code;
    }

    public function destroy(Product $product)
    {
        Product::where('id',$product->id)->delete();
        CategoryProduct::where('product_id',$product->id)->delete();
        ProductImages::where('productid',$product->id)->delete();
        ProductTags::where('productid',$product->id)->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function show(Product $product)
    {
        return view('products.productdetails')->with(compact('product'));
    }

    public function checkmodel(Request $request)
    {
        $productmodels = Product::select('mfr')->where([['mfr','like',$request->model.'%']])->take(5)->get();
        if(count($productmodels)>0){
            $output = '<ul class="list-group" style="display:block;position:absolute;z-index:1;">';
            foreach($productmodels as $row){
                $output .= '<li class="list-group-item" style="background-color:red;color:black;">'.$row->mfr.'</li>';
            }
            $output .='</ul>';
        }
        else
        {
            $output = null;
        }
        echo $output;
    }

    public function changeproductstatus(Request $request)
    {
        if($request !== null){
            $productdata = Product::where('id',$request->productid)->first();
            if($productdata->status == true){
                Product::where('id',$request->productid)->update(['status'=>false]);
            }else{
                Product::where('id',$request->productid)->update(['status'=>true]);
            }
        }

        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);
    }

    public function makefeatured(Request $request)
    {
        if($request !== null){
            $productdata = Product::where('id',$request->productid)->first();
            if($productdata->isfeatured == true){
                Product::where('id',$request->productid)->update(['isfeatured'=>false]);
            }else{
                Product::where('id',$request->productid)->update(['isfeatured'=>true]);
            }
        }

        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);
    }
}
