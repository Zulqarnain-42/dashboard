<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoice($id)
    {
        $service = Services::where('id',$id)->get();
        $collectionservicesdetails = DB::select("CALL fetchservices('".$id."')");
        return view("invoices.invoice")->with(compact('service','collectionservicesdetails'));
    }
}
