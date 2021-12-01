<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request){
        $result['title'] = 'Internwheel';
        return view('index', $result);
    }
    
    public function login(){
        $result['title'] = 'Login';
        return view('login', $result);
    }
    public function auth(Request $request){
        $user = $request->post('user');
        $password = $request->post('password');

        $result=Admin::Where(['username'=>$user, 'password'=>$password])->get();
        $result2=Admin::Where(['email'=>$user, 'password'=>$password])->get();
        if(isset($result[0]->id) || isset($result2[0]->id)){
            $request->session()->put('ADMIN_LOGIN', true);
            if(isset($result[0]->id)){
                $request->session()->put('ADMIN_ID', $result['0']->id);
            }else{
                $request->session()->put('ADMIN_ID', $result2['0']->id);
            }
            $request->session()->put('ADMIN_TIME', now());
            return redirect('admin');
        }
        else{
            $request->session()->flash('error', 'please enter valid login details');
            return redirect('login');
        }
        
    }
}
