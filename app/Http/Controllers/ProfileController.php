<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        dd($request);
    }
}
