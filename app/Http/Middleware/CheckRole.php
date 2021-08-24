<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$role)
    {
        if(!$request->user()){
            return redirect("login");
        }else{
            if(!$request->user()->hasRole($role)){
              return redirect("home");
            }
        }
        return $next($request);
    }
}
