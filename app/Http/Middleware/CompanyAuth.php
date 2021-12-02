<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyAuth
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
        if($request->session()->has('CMPY_LOGIN')){
            \View::share('user', Company::where('id', session()->get('CMPY_ID'))->get());
            \View::share('type', 'cmpy');
        }
        else{
            $request->session()->flash('error', 'Access denied');
            return redirect('login');
        }
        return $next($request);
    }
}
