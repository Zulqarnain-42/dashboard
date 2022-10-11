<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Sales;
use App\Models\Purchase;

class Transactions extends Model
{
    use HasFactory;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
