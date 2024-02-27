<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;

use Closure;

class IsAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $task = Route::current()->parameters()['task'];
        
        if(!auth()->user()->is_admin && $task->user->id != auth()->user()->id){
            return abort(401);
        }

        return $next($request);
    }
}