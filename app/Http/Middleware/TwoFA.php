<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFA
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isVerified) {
            return $next($request);
        }

        return redirect()->route('verify.get');
    }
}
