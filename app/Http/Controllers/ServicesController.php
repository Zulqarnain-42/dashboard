<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Services\StoreServiceRequest;
use App\Http\Requests\Services\UpdateServicesRequest;
use App\Models\Services;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ServicesDetails;
use App\Models\ServicesStatuses;
use App\Models\ServiceWorkHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServicesController extends Controller
{
    public function index()
    {
        $collectionservices = Services::get();
        $collectionservicesStatus = ServicesStatuses::get();
        return view('services.service')->with(compact('collectionservices','collectionservicesStatus'));
    }

    public function create()
    {
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        return view('services.create')->with(compact('collectionbrand'));
    }

    public function store(StoreServiceRequest $request)
    {
        $this->validate($request, [
            'customername' => 'required',
            'productmodel' => 'required',
            'brand' => 'required',
            'productitem' => 'required',
            'serialno' => 'required',
        ]);

        $newservice = new Services();
        $newservice->joborder = $this->generateUniqueCode();
        $newservice->arrivingdate = Carbon::now();
        $newservice->customername = $request->customername;
        $newservice->email = $request->email;
        $newservice->phone = $request->mobile;
        $newservice->comments = $request->comments;
        $newservice->includes = $request->includes;
        $newservice->userid = Auth()->user()->id;
        $newservice->save();

        $newservicesdetails = new ServicesDetails();

        if($request->productitem){
            for($i = 0; $i < count($request->productitem) ; $i++){
                $service_details[] = [
                    'Item' => $request->productitem[$i],
                    'model' => $request->productmodel[$i],
                    'brandid' => $request->brand[$i],
                    'serialno' => $request->serialno[$i],
                    'servicesid' => $newservice->id,
                ];
            }
        }

        DB::table('services_details')->insert($service_details);
        $newserviceworkhistory = new ServiceWorkHistory();
        $newserviceworkhistory->serviceid = $newservice->id;
        $newserviceworkhistory->servicestatusid = 1;
        $newserviceworkhistory->save();

        return redirect()->route('services.index');
    }

    public function edit(Services $service)
    {
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        $collectionservicesdetails = ServicesDetails::where('servicesid',$service->id)->get();
        return view('services.form')->with(compact('service','collectionbrand','collectionservicesdetails'));
    }

    public function update(UpdateServicesRequest $request,Services $service)
    {
        $this->validate($request, [
            'customername' => 'required',
            'productmodel' => 'required',
            'brand' => 'required',
            'productitem' => 'required',
            'serialno' => 'required',
        ]);

        $service->customername = $request->customername;
        $service->email = $request->email;
        $service->phone = $request->mobile;
        $service->comments = $request->comments;
        $service->includes = $request->includes;
        $service->userid = Auth()->user()->id;
        $service->update();

        if($request->productitem){
            $servicesdetails = ServicesDetails::where('servicesid', $request->id)->delete();
            if($servicesdetails > 1){
                for($i = 0; $i < count($request->productitem) ; $i++){
                    $service_details[] = [
                        'Item' => $request->productitem[$i],
                        'model' => $request->productmodel[$i],
                        'brandid' => $request->brand[$i],
                        'serialno' => $request->serialno[$i],
                        'servicesid' => $request->id,
                    ];
                }
            }
        }
        return redirect()->route('services.index');
    }

    public function destroy(Services $service)
    {
        Services::where('id', $service->id)->delete();
        ServicesDetails::where('servicesid',$service->id)->delete();
        return back();
    }

    public function generateUniqueCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;
        $code = '';
        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
        if (Services::where('joborder', $code)->exists()) {
            $this->generateUniqueCode();
        }
        return $code;
    }

    public function servicesdetails($id)
    {
        $service = Services::where('id',$id)->get();
        $collectionservicesdetails = DB::select("CALL fetchservices('".$id."')");
        $collectionworkhistory = DB::select("CALL fetchworkhistory('".$id."')");
        return view('services.servicesdetails')->with(compact('collectionservicesdetails','service','collectionworkhistory'));
    }

    public function updateworkstatus(Request $request)
    {
        $newserviceworkhistory = new ServiceWorkHistory();
        $newserviceworkhistory->serviceid = $request->serviceid;
        $newserviceworkhistory->servicestatusid = $request->servicestatus;
        $newserviceworkhistory->comments = $request->comments;
        $newserviceworkhistory->save();
        return back();
    }
}
