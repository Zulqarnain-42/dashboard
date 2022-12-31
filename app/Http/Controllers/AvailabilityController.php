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
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Availability::get())->tojson();
        }
        $collectionstatus = Status::get();
        return view('availability.index')->with(compact('collectionstatus'));
    }

    public function store(StoreAvailabilityRequest $request)
    {
        $dbcheck = Availability::where([['name', '=', $request->availabilityname]])->first();
        if($dbcheck === null){
            $request->validate([
                'availabilityname' => 'required'
            ]);

            $newavailability = new Availability();
            $newavailability->name = $request->availabilityname;
            $newavailability->status = true;

            $newavailability->save();
        }else{
            return redirect()->route('availability.index')->with('alert','Availability Already Exist!');
        }
        return response()->json([
            'success'=>'Record Inserted Successfully!'
        ]);
    }

    public function edit(Availability $availability)
    {
        return response()->json([
            'data'=>$availability
        ]);
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
        return response()->json([
            'success'=>'Record Deleted Successfully!'
        ]);
    }

    public function changeavailabilitystatus(Request $request)
    {
        if($request !== null){
            $availabilitydata = Availability::where('id',$request->availabilityid)->first();
            if($availabilitydata->status == true){
                Availability::where('id',$request->availabilityid)->update(['status'=>false]);
            }else{
                Availability::where('id',$request->availabilityid)->update(['status'=>true]);
            }
        }

        return response()->json([
            'success' => 'Record Updated Successfully!'
        ]);
    }
}
