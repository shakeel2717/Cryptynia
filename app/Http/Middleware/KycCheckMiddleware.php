<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KycCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // checking if kyc is approved
        if (auth()->user()->kyc && auth()->user()->kyc->status == true) {
            return $next($request);
        } else {
            return redirect()->route('user.kyc.index')->withErrors("Please Complete your KYC First");
        }
    }
}
