<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()){
            return redirect('home')->with('error', 'You are not allowed to access this page.');
        }
        if(auth()->user()->is_teacher == 0) {
            return $next($request);
        }else{
            return redirect('home')->with('error', 'You are not allowed to access this page.');
        }
    }
}
