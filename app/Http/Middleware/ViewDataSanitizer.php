<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class ViewDataSanitizer {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        foreach ($request->input() as $key => $value) {
            if ($value == '' || $value = "") {
                $request->request->set($key, null);
            }
        }
        
        return $next($request);
    }

}
