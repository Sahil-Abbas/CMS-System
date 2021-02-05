<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Blog;

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
        $blog_id = $request->id;

        $blog = Blog::find($blog_id)->user_id;

        if($request->user()->id === $blog && $request->user()->id == 3){
            return $next($request);
        }

        return redirect('/');
    }
}
