<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Str;

class BrandCategory extends Model
{
    use HasFactory;
    use NodeTrait;
    protected $guarded = [];
    protected $table = 'brand_categories';
    protected $fillable = ['title','brandid'];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brandid','id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($brandcategory) {

            $brandcategory->slug = $brandcategory->createSlug($brandcategory->title);

            $brandcategory->save();
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
