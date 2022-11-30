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
use App\Models\RelatedProducts;
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
    public function index()
    {
        $collectionproduct = Product::get();
        return view('products.index')->with(compact('collectionproduct'));
    }

    public function create()
    {
        $collectioncategory[] = array();
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        $collectioncategory = Category::where([['status', true], ['visibility', true]])->get();
        $categorytree =  Category::where([['status',true],['visibility',true]])->get()->toTree();
        $collectionproducts = Product::where([['status', true], ['visibility', true]])->get();
        $collectionstatus = Status::get();
        $collectionvisibility = Visibilty::get();
        $collectionavailability = Availability::where([['status', true]])->get();

        return view('products.form')->with(compact('collectionbrand',
        'collectioncategory',
        'collectionproducts',
        'collectionstatus',
        'collectionvisibility',
        'collectionavailability'));
    }

    public function store(StoreProductRequest $request)
    {
        $dbcheck = Product::where([['title', '=', $request->producttitle],['mfr','=',$request->mfr],['brandid','=',$request->brand]])->first();

        if($dbcheck === null){
            $request->validate([
                'producttitle' => 'required',
                'mfr' => 'required',
                'saleprice' => 'required',
                'status' => 'required',
                'visibility' => 'required',
                'productcategories' => 'required',
            ]);

            $brand = Brand::findOrFail($request->brand);
            $product = new Product();

            if($request->ProductsThumbnailFilePond){
                $newfilename = Str::after($request->ProductsThumbnailFilePond,'tmp/');
                Storage::disk('public')->move($request->ProductsThumbnailFilePond,"images/thumbnail/$newfilename");
                $product->thumbnail = "storage/images/thumbnail/$newfilename";
            }

            $product->productcode = $this->generateUniqueCode().''.$request->mfr;
            $product->title = $request->producttitle;
            $product->longdescription = $request->longdescription;
            $product->shortdescription = $request->shortdes;
            $product->mfr = strtoupper($request->mfr);
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
            $product->slug = $request->producttitle;
            $product->retailprice = $request->retailprice;
            $product->availabilityid = $request->availability;
            $product->lensmounttype = $request->lensmount;
            $product->displaysize = $request->displaysize;
            $product->videoresolution = $request->videoresolution;
            $product->cardtype = $request->cardtype;
            $product->digitalinterface = $request->digitalinterface;
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

            $product->inventories()->create([
                'sharjahquantity' => 0,
                'officequantity' => 0,
                'addedat' => Carbon::now(),
                'product_id' => $product->id,
                'userid' => Auth::user()->id,
                'addedat' => Carbon::now(),
            ]);

            if ($request->producttags) {
                foreach ($request->producttags as $tags) {
                    $product->producttags()->create([
                        'productid' => $product->id,
                        'tags' => $tags,
                    ]);
                }
            }

            if ($request->relatedproducts) {
                foreach ($request->relatedproducts as $related) {
                    $product->relatedproducts()->create([
                        'productid' => $product->id,
                        'relatedproductsid' => $related,
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
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        $collectioncategory = Category::where([['status', true], ['visibility', true]])->get();
        $collectionproducts = Product::where([['status', true], ['visibility', true]])->get();
        $relatedproducts = $product::find($product->id)->relatedproducts;
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
            'relatedproducts',
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
            'mfr' => 'required',
            'saleprice' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);

        if($request->ProductsThumbnailFilePond){
            $newfilename = Str::after($request->ProductsThumbnailFilePond,'tmp/');
            Storage::disk('public')->move($request->ProductsThumbnailFilePond,"images/thumbnail/$newfilename");
            $product->thumbnail = "storage/images/thumbnail/$newfilename";
        }

        if($product->productcode === null){
            $product->productcode = $this->generateUniqueCode().''.$request->mfr;
        }


        $product->title = $request->producttitle;
        $product->longdescription = $request->longdescription;
        $product->shortdescription = $request->shortdes;
        $product->mfr = strtoupper($request->mfr);
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
        $product->slug = $request->producttitle;
        $product->retailprice = $request->retailprice;
        $product->availabilityid = $request->availability;
        $product->lensmounttype = $request->lensmount;
        $product->displaysize = $request->displaysize;
        $product->videoresolution = $request->videoresolution;
        $product->cardtype = $request->cardtype;
        $product->digitalinterface = $request->digitalinterface;

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

        if ($request->producttags) {
            $prodtags = $product->producttags()->delete();
            if ($prodtags > 1) {
                foreach ($request->producttags as $tags) {
                    $product->producttags()->create([
                        'productid' => $product->id,
                        'tags' => $tags,
                    ]);
                }
            }
            else if($request->producttags != null) {
                foreach ($request->producttags as $tags) {
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


        if ($request->relatedproducts) {
            $relatedprod = RelatedProducts::where('productid', $product->id)->delete();
            if ($relatedprod > 1) {
                foreach ($request->relatedproducts as $related) {
                    $product->relatedproducts()->create([
                        'productid' => $product->id,
                        'relatedproductsid' => $related,
                    ]);
                }
            } else {
                foreach ($request->relatedproducts as $related) {
                    $product->relatedproducts()->create([
                        'productid' => $product->id,
                        'relatedproductsid' => $related,
                    ]);
                }
            }
        }else{

            $findrelatedproducts = RelatedProducts::where('productid', $product->id)->get();
            if($findrelatedproducts){
                RelatedProducts::where('productid', $product->id)->delete();
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

        while (strlen($code) < 4) {
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
        RelatedProducts::where('productid',$product->id)->delete();
        return back();
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
}
