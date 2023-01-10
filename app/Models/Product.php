<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImages;
use App\Models\ProductTags;
use App\Models\RelatedProducts;
use App\Models\ProductCategories;
use App\Models\Brand;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use App\Models\Availability;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory,Searchable;

    protected $table = 'products';
    protected $guarded = [];
    protected $fillable = ['producttitle',
                            'mfr',
                            'length',
                            'width',
                            'height',
                            'weight',
                            'retailprice',
                            'saleprice',
                            'productcategories',
                            'brand'];

    public function productimages()
    {
        return $this->hasMany(ProductImages::class,'productid','id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

    public function producttags()
    {
        return $this->hasMany(ProductTags::class,'productid','id');
    }

    public function relatedproducts()
    {
        return $this->hasMany(RelatedProducts::class,'productid','id');
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function history()
    {
        return $this->hasMany(ProductHistory::class,'product_id','id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($product) {

            $product->slug = $product->createSlug($product->title);

            $product->save();
        });
    }

    private function createSlug($title)
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {

            $max = static::whereTitle($title)->latest('id')->skip(1)->value('slug');

            if (isset($max[-1]) && is_numeric($max[-1])) {

                return preg_replace_callback('/(\d+)$/', function ($mathces) {

                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
