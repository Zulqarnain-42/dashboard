<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companydetails = Company::get();
        return view('company.index')->with(compact('companydetails'));
    }

    public function update(UpdateCompanyRequest $request,Company $company)
    {
        if($company === null){
            $newcompany = new company();

            $newcompany->name = $request->name;
            $newcompany->address = $request->address;
            $newcompany->email = $request->email;
            $newcompany->workinghours = $request->workinghours;
            $newcompany->phonenumber = $request->phonenumber;
            $newcompany->facebooklink = $request->facebooklink;
            $newcompany->twitterlink = $request->twitterlink;
            $newcompany->youtubelink = $request->youtubelink;
            $newcompany->instagramlink = $request->instagramlink;

            $newcompany->save();
        }else{
            $company->name = $request->name;
            $company->address = $request->address;
            $company->email = $request->email;
            $company->workinghours = $request->workinghours;
            $company->phonenumber = $request->phonenumber;
            $company->facebooklink = $request->facebooklink;
            $company->twitterlink = $request->twitterlink;
            $company->youtubelink = $request->youtubelink;
            $company->instagramlink = $request->instagramlink;

            $company->update();
        }
    }
}
