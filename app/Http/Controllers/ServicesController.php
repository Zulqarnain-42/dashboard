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
        return view('services.service')->with(compact('collectionservices'));
    }

    public function create()
    {
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        return view('services.create')->with(compact('collectionbrand'));
    }

    public function store(StoreServiceRequest $request)
    {
        $this->validate($request, [
            'model' => 'required',
            'brandid' => 'required',
            'item' => 'required',
            'serialno' => 'required',
        ]);

        $newservice = new Services();
        $newservice->joborder = $this->generateUniqueCode();
        $newservice->arrivingdate = Carbon::now();
        $newservice->save();

        $brand = Brand::findOrFail($request->brandid);

        $newservicesdetails = new ServicesDetails();

        if($request->item){
            for($i = 0; $i < count($request->item) ; $i++){
                $service_details[] = [
                    'Item' => $request->item[$i],
                    'model' => $request->model[$i],
                    'brandid' => $request->brandid[$i],
                    'serialno' => $request->serialno[$i],
                    'comments' => $request->comments[$i],
                    'includes' => $request->includes[$i],
                    'servicesid' => $newservice->id,
                ];
            }
        }

        DB::table('services_details')->insert($service_details);

        return redirect()->route('services.index');
    }

    public function edit(Services $service)
    {
        $collectionbrand = Brand::where([['status', true], ['visibility', true]])->get();
        $collectionservicesdetails = ServicesDetails::where('servicesid',$service->id)->get();
        $collectionservicesStatus = ServicesStatuses::get();
        return view('services.form')->with(compact('service','collectionbrand','collectionservicesdetails','collectionservicesStatus'));
    }

    public function update(UpdateServicesRequest $request)
    {
        $this->validate($request, [
            'model' => 'required',
            'brandid' => 'required',
            'item' => 'required',
            'serialno' => 'required',
        ]);

        if($request->item){
            $servicesdetails = ServicesDetails::where('servicesid', $request->servicesid)->delete();
            if($servicesdetails > 1){
                for($i = 0; $i < count($request->item) ; $i++){
                    $service_details[] = [
                        'Item' => $request->item[$i],
                        'model' => $request->model[$i],
                        'brandid' => $request->brandid[$i],
                        'serialno' => $request->serialno[$i],
                        'comments' => $request->comments[$i],
                        'includes' => $request->includes[$i],
                        'servicesid' => $request->servicesid
                    ];
                }
            }
        }

        DB::table('services_details')->insert($service_details);

        $newworkstatuses = new ServiceWorkHistory();
        $newworkstatuses->servicestatusid = $request->workstatus;
        $newworkstatuses->serviceid = $request->servicesid;
        $newworkstatuses->save();

        return redirect()->route('services.index');
    }

    public function destroy(Services $service)
    {
        Services::where('id', $service->id)->delete();
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
        $collectionservicesdetails = DB::select("CALL 	fetchservices('".$id."')");
        $collectionworkhistory = DB::select("CALL 	fetchworkhistory('".$id."')");
        return view('services.servicesdetails')->with(compact('collectionservicesdetails','service','collectionworkhistory'));
    }
}
