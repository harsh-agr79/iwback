<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeAuth
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
        if($request->session()->has('CAND_LOGIN')){
            \View::share('user', Employee::where('id', session()->get('CAND_ID'))->get());
            \View::share('type', 'cand');
        }
        else{
            $request->session()->flash('error', 'Access denied');
            return redirect('login');
        }
        return $next($request);
    }
}
