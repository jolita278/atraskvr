<?php

namespace App\Http\Middleware;

use Closure;

class NotAdminRestriction
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
        dd(auth()->user()->rolesConnectionData->pluck('id')->toArray());
        {
            if (in_array('super-admin', auth()->user()->roles()->pluck('id')->toArray())) {
                return $next($request);
            }
            abort(403,'No access');
        }
    }
}
