<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckKyc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_kyc != 0) {
            return $next($request);
        }
        $notify[] = ['error','Sorry, You have to verification data first.'];
        return redirect()->route('user.home')->withNotify($notify);
    }
}
