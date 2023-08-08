<?php

namespace App\Http\Middleware;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;
// class Authenticate extends  Middleware
class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }

        $request->session()->flash('form', 'login');

        return redirect()->route('home');
    }



}
