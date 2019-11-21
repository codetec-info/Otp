<?php

namespace App\Http\Controllers;

use App\Http\Requests\OTPRequest;
use Illuminate\Support\Facades\Cache;

class VerifyOPTController extends Controller
{
    public function verify(OTPRequest $request)
    {
        if(request('OTP') == auth()->user()->OTP()) {
            auth()->user()->update(['isVerified' => true]);
            return redirect()->route('home');
        }

        return back()->withErrors('OTP has expired or is invalid');
    }

    public function showVerifyForm($otp = '')
    {
        return view('OTP.verify', compact('otp'));
    }
}
