<?php

namespace App\Http\Middleware;

use Closure;

class MultiLanguage
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
        $language = request()->segment(1);
        if (in_array($language, ['en', 'lt']))
        {
            app()->setLocale($language);
            return $next($request);
        }
        return redirect('/lt');
    }
}
