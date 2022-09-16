<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $collectionproduct = Product::get();
        return view('products.index')->with(compact('collectionproduct'));
    }

    public function create()
    {
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        $collectioncategory = Category::where([['status', true], ['visibility', true]])->get();
        $collectionproducts = Product::where([['status', true], ['visibility', true]])->get();
        return view('products.form')->with(compact('collectionbrand', 'collectioncategory', 'collectionproducts'));
    }

    public function store(StoreProductRequest $request)
    {
        $request->validate([
            'producttitle' => 'required',
            'mfr' => 'required',
            'orignalprice' => 'required',
            'saleprice' => 'required',
            'status' => 'required',
            'visibility' => 'required',
            'productcategories' => 'required',
            'producttags' => 'required',
        ]);

        $brand = Brand::findOrFail($request->brand);
        $productcode = $this->unique_code(9);
        $image_name = null;
        if ($request->hasFile('thumbnail')) {
            $destination_path = 'public/images/products';
            $image = $request->file('thumbnail');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs($destination_path, $image_name);
        }

        $product = $brand->product()->create([
            'productcode' => $productcode,
            'title' => $request->producttitle,
            'longdescription' => $request->longdescription,
            'shortdescription' => $request->shortdes,
            'mfr' => $request->mfr,
            'upc' => $request->upc,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'weight' => $request->weight,
            'orignalprice' => $request->orignalprice,
            'price' => $request->saleprice,
            'status' => $request->status,
            'visibility' => $request->visibility,
            'inthebox' => $request->inthebox,
            'specifications' => $request->specifications,
            'metatitle' => $request->metatitle,
            'metakeywords' => $request->metakeywords,
            'metadescription' => $request->metadescription,
            'brandid' => $request->brand,
            'thumbnail' => $image_name,
            'lensmounttype' => $request->lensmount,
            'displaysize' => $request->displaysize,
            'videoresolution' => $request->videoresolution,
            'cardtype' => $request->cardtype,
            'digitalinterface' => $request->digitalinterface,
            'slug' => Str::slug($request->producttitle, '-'),
        ]);

        if ($request->productfiles) {
            foreach ($request->productfiles as $productimage) {
                $product->productimages()->create([
                    'productid' => $product->id,
                    'images' => $productimage,
                ]);
            }
        }

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
            $productcategories = new ProductCategories();
            foreach ($request->productcategories as $categories) {
                $category = Category::findOrFail($categories);
                $productcategories->create([
                    'productid' => $product->id,
                    'categoryid' => $category->id,
                ]);
            }
        }

        return redirect()->route('product.index');
    }

    public function edit(Product $product)
    {
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        $collectioncategory = Category::where([['status', true], ['visibility', true]])->get();
        $collectionproducts = Product::where([['status', true], ['visibility', true]])->get();
        $relatedproducts = $product::find($product->id)->relatedproducts;
        $selectedproductimages = $product::find($product->id)->productimages;
        $selectedproducttags = $product::find($product->id)->producttags;
        return view('products.form')->with(compact(
            'product',
            'collectionbrand',
            'collectioncategory',
            'collectionproducts',
            'relatedproducts',
            'selectedproductimages',
            'selectedproducttags'
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validate([
            'producttitle' => 'required',
            'mfr' => 'required',
            'orignalprice' => 'required',
            'saleprice' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ]);

        $brand = Brand::findOrFail($request->brand);

        $image_name = null;

        if ($request->hasFile('thumbnail')) {

            $destination = 'storage/images/products/' . $product->thumbnail;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $destination_path = 'public/images/products';
            $image = $request->file('thumbnail');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs($destination_path, $image_name);
        }

        $product = $brand->product()->update([
            'title' => $request->producttitle,
            'longdescription' => $request->longdescription,
            'shortdescription' => $request->shortdes,
            'mfr' => $request->mfr,
            'upc' => $request->upc,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'weight' => $request->weight,
            'orignalprice' => $request->orignalprice,
            'price' => $request->saleprice,
            'status' => $request->status,
            'visibility' => $request->visibility,
            'inthebox' => $request->inthebox,
            'specifications' => $request->specifications,
            'metatitle' => $request->metatitle,
            'metakeywords' => $request->metakeywords,
            'metadescription' => $request->metadescription,
            'brandid' => $request->brand,
            'thumbnail' => $image_name,
            'slug' => Str::slug($request->producttitle, '-'),
        ]);

        if ($request->productfiles) {
            foreach ($request->productfiles as $productimage) {
                $product->productimages()->create([
                    'productid' => $product->id,
                    'images' => $productimage,
                ]);
            }
        }

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
            $productcategories = new ProductCategories();
            foreach ($request->productcategories as $categories) {
                $category = Category::findOrFail($categories);
                $productcategories->create([
                    'productid' => $product->id,
                    'categoryid' => $category->id,
                ]);
            }
        }

        return redirect()->route('product.index');
    }

    public function uploadproducts(Request $request)
    {
        $file = $request->file('file');
        if ($request->hasFile('file')) {
            $destination_path = 'public/images/products';
            $image = $request->file('file');
            $image_name = date('YmdHi') . $image->getClientOriginalName();
            $path = $request->file('file')->storeAs($destination_path, $image_name);
        }
        return response()->json([
            'name' => $image_name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function removeproducts(Request $request)
    {
        $destination = 'storage/images/products/' . trim($request->name);
        if (File::exists($destination)) {
            File::delete($destination);
        }
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
