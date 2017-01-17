<?php

namespace App\Http\Middleware;

use Closure;

class Active
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
        // active
        if (\Auth::check()) {
            $user = \Auth::user();
            $user->active_at = date('Y-m-d H:i:s');
            $user->save();
        }
        return $next($request);
    }
}
