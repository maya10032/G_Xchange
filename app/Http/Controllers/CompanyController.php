<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function profile()
    {
        return view('company.companyprofile');
    }

    public function recruit()
    {
        return view('company.recruit');
    }
}
