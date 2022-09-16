<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImages;
use App\Models\ProductTags;
use App\Models\RelatedProducts;
use App\Models\ProductCategories;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

    public function productimages()
    {
        return $this->hasMany(ProductImages::class,'productid','id');
    }

    public function producttags()
    {
        return $this->hasMany(ProductTags::class,'productid','id');
    }

    public function relatedproducts()
    {
        return $this->hasMany(RelatedProducts::class,'productid','id');
    }
}
