<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions;
use App\Models\Users;
use App\Models\Warehouse;

class Booking extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }

    public function customer()
    {
        return $this->belongsTo(Users::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
