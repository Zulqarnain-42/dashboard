<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTags extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'product_tags';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
