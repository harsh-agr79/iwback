<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Admin;

class AdminAuth
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
        if($request->session()->has('ADMIN_LOGIN')){
            \View::share('user', Admin::where('id', session()->get('ADMIN_ID'))->get());
            \View::share('type', 'admin');
        }
        else{
            $request->session()->flash('error', 'Access denied');
            return redirect('login');
        }
        return $next($request);
    }
}
