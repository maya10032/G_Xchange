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

    public function service()
    {
        return view('company.service');
    }

    public function privacy()
    {
        return view('company.privacy');
    }

    public function transaction()
    {
        return view('company.transaction');
    }

    public function funding()
    {
        return view('company.funding');
    }

    public function law()
    {
        return view('company.law');
    }
}
