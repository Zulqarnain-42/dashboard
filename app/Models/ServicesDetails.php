<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;
use App\Models\Brand;

class ServicesDetails extends Model
{
    use HasFactory;

    protected $fillable = ['item'];

    public function services()
    {
        return $this->belongsTo(Services::class);
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }
}
