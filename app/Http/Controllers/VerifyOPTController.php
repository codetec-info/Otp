<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyOPTController extends Controller
{
    /**
     * @name
     *
     * @return
     */
    public function verify(Request $request)
    {
        if(request('OTP') === Cache::get('OTP')) {
            auth()->user()->update(['isVerified' => true]);
            return response(null, 201);
        }
    }
}
