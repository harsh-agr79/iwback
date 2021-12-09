<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Sector;
use App\Models\Home;
use App\Models\Company;
use App\Mail\forgotpassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Crypt;
use Carbon\Carbon;

class FirstController extends Controller
{
    public function index(Request $request){
        $result['title'] = 'Internwheel';
        $result['sector'] = Sector::where('sectorshow', 'on')->get();
        $result['sliders'] = Home::where('section','slider')->orderBy('contorder','ASC')->get();
        if(session()->has('CMPY_LOGIN')){
            $result['user'] = Company::where('id',session()->get('CMPY_ID'))->get();
        }
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
    public function forgotpassword(Request $request){
        $result['title'] = 'Forgot Password';
        if(session()->has('ADMIN_LOGIN')){
            return redirect('/');
        }
        elseif(session()->has('CMPY_LOGIN')){
            return redirect('/');
        }
        else{
            return view('forgotpassword', $result);
        }
    }
    public function fpwmail(Request $request){
        $email = $request->post('email');
        $cmp = Company::where('email',$email)->get();
        $randomid = rand(99999,9999999);
        if(isset($cmp[0]->id)){
            Company::where('email',$email)->update([
                'extra4'=>Crypt::encrypt($randomid),
                'extra5'=>time(),
            ]);
            $data=['name'=>$cmp[0]->firstname, 'randomid'=>$randomid];
            Mail::to($email)->send(new forgotpassword($data));
            return ['pw'=>'Check Your email for verification code'];
        }
        else
        {
            return ['pw'=>'Invalid Email ID'];
        }
    }
    public function fpwvc(Request $request){
        $email = $request->post('email');
        $code = $request->post('vfcode');
        $cmp = Company::where('email',$email)->get();
        $code2 = Crypt::decrypt($cmp[0]->extra4);
        if($code2 == $code)
        {
            return ['pw'=>'The code has been verified'];
        }
        else
        {
            return ['pw'=>'Invalid Code'];
        }

    }
    public function fpwnp(Request $request){
        $email = $request->post('email');
        $code = $request->post('verifycode');
        $password = $request->post('password');
        $password2 = $request->post('confirm-password');
        $randomid = rand(111111111111,999999999999999);
        $cmp = Company::where('email',$email)->get();
        $code2 = Crypt::decrypt($cmp[0]->extra4);
        if($code2 == $code)
        {
            if($password === $password2){
                Company::where('email',$email)->update([
                    'password'=>Crypt::encrypt($password),
                    'extra4'=>Crypt::encrypt($randomid),
                ]);
            return ['pw'=>'The password has been changed'];
            }else{return ['pw'=>'The passwords do not match'];}
                
        }
        else
        {
            return ['pw'=>'Invalid Password'];
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
                if($password == Crypt::decrypt($result4[0]->password)){
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
