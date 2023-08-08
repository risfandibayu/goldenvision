<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRO
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
        if (countAllBonus() < 10000000 || auth()->user()->is_manag) {
            return $next($request);
        }
        $notify[] = ['error','Sorry, Kamu Akumulasi Bonus Kamu Sudah Mencapai 10 Jt, Segera Lakukan Repeat Order Untuk WD!'];
        return redirect()->route('user.plan.index')->withNotify($notify);
    }
}
