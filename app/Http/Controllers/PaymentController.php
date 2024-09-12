<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }

    public function payment(Request $request)
    {
        // 試しにデバッグしてみる
        dd($request->all());
    }
    
}
