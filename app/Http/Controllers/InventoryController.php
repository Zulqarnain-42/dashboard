<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function warehouse()
    {
        return view('inventory.warehouse');
    }

    public function booking()
    {
        return view('inventory.booking');
    }
}
