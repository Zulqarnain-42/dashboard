<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\Status;
use App\Models\Visibilty;
use App\Http\Requests\Availability\StoreAvailabilityRequest;
use App\Http\Requests\Availability\UpdateAvailabilityRequest;

class AvailabilityController extends Controller
{
    public function index()
    {
        $collectionavailability = Availability::get();
        $collectionstatus = Status::get();
        return view('availability.index')->with(compact('collectionavailability','collectionstatus'));
    }

    public function store(StoreAvailabilityRequest $request)
    {
        $dbcheck = Availability::where([['name', '=', $request->availabilitytitle]])->first();
        if($dbcheck === null){
            $request->validate([
                'availabilitytitle' => 'required'
            ]);

            $newavailability = new Availability();
            $newavailability->availabilitycode = $this->generateUniqueCode();
            $newavailability->name = $request->availabilitytitle;
            $newavailability->status = $request->status;

            $newavailability->save();
        }else{
            return redirect()->route('availability.index')->with('alert','Availability Already Exist!');
        }
        return redirect()->route('availability.index')->with('success','Availability Added Successfully!');
    }

    public function update(UpdateAvailabilityRequest $request, Availability $availability)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required'
        ]);

        if($availability->availabilitycode === null){
            $availability->availabilitycode = $this->generateUniqueCode();
        }

        $availability->name = $request->title;
        $availability->quantity = $request->description;
        $availability->status = $request->status;
        $availability->visibility = $request->visibility;

        $availability->update();

        return redirect()->route('availability.index')->with('success','Availability Updated Successfully!');
    }

    public function destroy(Availability $availability)
    {
        Availability::where('id',$availability->id)->delete();
        return back();
    }

    public function generateUniqueCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 8;
        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Availability::where('availabilitycode', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }
}
