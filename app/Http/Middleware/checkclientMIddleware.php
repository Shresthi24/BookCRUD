<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\vendordt;
use Illuminate\Http\RedirectResponse;

class checkclientMIddleware
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
        //dd(Auth::user()->id);
        $formdata=vendordt::where('Vendor_id','=',Auth::user()->id)->pluck('ifformsubmitted');

        $formdata=empty($formdata->toArray())?0:$formdata[0];

//dd($formdata->toArray());
        if($formdata==1){
        return redirect()->route('show');
        }
        return $next($request);
    }
}
