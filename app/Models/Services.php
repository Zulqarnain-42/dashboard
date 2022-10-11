<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServicesDetails;

class Services extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'services';

    public function servicesdetails()
    {
        return $this->hasMany(ServicesDetails::class,'servicesid','id');
    }


}
