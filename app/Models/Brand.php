<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ServicesDetails;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'brands';

    public function product()
    {
        return $this->hasMany(Product::class,'brandid','id');
    }

    public function servicesdetails()
    {
        return $this->hasMany(ServicesDetails::class,'brandid','id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($brand) {

            $brand->slug = $brand->createSlug($brand->title);

            $brand->save();
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
