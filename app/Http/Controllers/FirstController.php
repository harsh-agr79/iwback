<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Sector;
use App\Models\Home;
use App\Models\Company;
use Illuminate\Support\Facades\View;
use Crypt;

class FirstController extends Controller
{
    public function index(Request $request){
        $result['title'] = 'Internwheel';
        $result['sector'] = Sector::where('sectorshow', 'on')->get();
        $result['sliders'] = Home::where('section','slider')->orderBy('contorder','ASC')->get();
        return view('index', $result);
    }
    
    public function login(Request $request){
        $result['title'] = 'Login';
        if(session()->has('ADMIN_LOGIN')){
            return redirect('/');
        }
        elseif(session()->has('CMPY_LOGIN')){
            return redirect('/');
        }
        else{
            return view('login', $result);
        }
    }
    public function registeremployer(Request $request){
        $result['title'] = 'Register|Employer';
        if(session()->has('ADMIN_LOGIN')){
            return redirect('/');
        }
        elseif(session()->has('CMPY_LOGIN')){
            return redirect('/');
        }
        else{
            return view('employerregister', $result);
        }
    }
    public function auth(Request $request){
        $user = $request->post('user');
        $password = $request->post('password');

        $check = Crypt::encrypt($password);

        echo $check;
        $result=Admin::Where(['username'=>$user, 'password'=>$password])->get();
        $result2=Admin::Where(['email'=>$user, 'password'=>$password])->get();
        $result3=Company::Where(['username'=>$user])->get();
        $result4=Company::Where(['email'=>$user])->get();
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
        elseif(isset($result3[0]->id) || isset($result4[0]->id)){

            if(isset($result3[0]->id)){
                if($password == Crypt::decrypt($result3[0]->password)){
                    $request->session()->put('CMPY_LOGIN', true);
                    $request->session()->put('CMPY_ID', $result3['0']->id);
                    $request->session()->put('CMPY_TIME', now());
                }
            }elseif(isset($result4[0]->id)){
                if($password == Crypt::decrypt($result3[0]->password)){
                    $request->session()->put('CMPY_LOGIN', true);
                    $request->session()->put('CMPY_ID', $result4['0']->id);
                    $request->session()->put('CMPY_TIME', now());
                }
            }
            return redirect('company/profile');
        }
        else{
            $request->session()->flash('error', 'please enter valid login details');
            return redirect('login');
        }
        
    }
}
