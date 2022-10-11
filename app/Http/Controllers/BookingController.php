<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Requests\Booking\StoreBookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        $collectionbooking = Booking::get();
        return view('booking.index')->with(compact('collectionbooking'));
    }

    public function store(StoreBookingRequest $request)
    {
        $request->validate([
            '' => 'required',
            '' => 'required',
            '' => 'required'
        ]);

        $newbooking = new Booking();

        $newbooking->bookingcode;
        $newbooking->bookedto;
        $newbooking->bookedby;
        $newbooking->customername;

        $newbooking->save();

        return redirect()->route('booking.index')->with('success','Booking Added Successfully!');
    }

}
