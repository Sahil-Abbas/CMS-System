<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class subscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        if($request->user()->id === $request->blog()->user_id){
            return $next($request);
        }
        return redirect('/');
    }
}
