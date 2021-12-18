<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Sector;
use App\Models\Home;
use App\Models\Company;
use App\Models\Employee;
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
        if(session()->has('CAND_LOGIN')){
            $result['user'] = Employee::where('id',session()->get('CAND_ID'))->get();
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
        elseif(session()->has('CAND_LOGIN')){
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
        elseif(session()->has('CAND_LOGIN')){
            return redirect('/');
        }
        else{
            return view('forgotpassword', $result);
        }
    }
    public function fpwmail(Request $request){
        $email = $request->post('email');
        $cmp = Company::where('email',$email)->get();
        $cand = Employee::where('email',$email)->get();
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
        elseif(isset($cand[0]->id)){
            if($cand[0]->google_id === NULL){
                Employee::where('email',$email)->update([
                    'fpwcode'=>Crypt::encrypt($randomid),
                    'fpwtime'=>time(),
                ]);
                $data=['name'=>$cand[0]->firstname, 'randomid'=>$randomid];
                Mail::to($email)->send(new forgotpassword($data));
                return ['pw'=>'Check Your email for verification code'];
            }
            else
            {
                return ['pw'=>'Invalid Email Id, Try logging in with google'];
            }
            
        }
        else
        {
            return ['pw'=>'Invalid Email ID'];
        }
    }
    public function fpwvc(Request $request){
        $email = $request->post('email');
        $code = $request->post('vfcode');
        $cmp = Company::where('email',$email)->first();
        $cand = Employee::where('email',$email)->first();

        if(isset($cmp)){
            $code2 = Crypt::decrypt($cmp->extra4);
        }
        else
        {
            $code2 = '0';
        }
        if(isset($cand)){
            $code3 = Crypt::decrypt($cand->fpwcode);
        }
        else
        {
            $code3 = '0';
        }

        if($code2 == $code)
        {
            return ['pw'=>'The code has been verified'];
        }
        elseif($code3 == $code)
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
        $cmp = Company::where('email',$email)->first();
        $cand = Employee::where('email',$email)->first();
        if(isset($cmp)){
            $code2 = Crypt::decrypt($cmp->extra4);
        }
        else
        {
            $code2 = '0';
        }
        if(isset($cand)){
            $code3 = Crypt::decrypt($cand->fpwcode);
        }
        else
        {
            $code3 = '0';
        }
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
        elseif($code3 == $code)
        {
            if($password === $password2){
                Employee::where('email',$email)->update([
                    'password'=>Crypt::encrypt($password),
                    'fpwcode'=>Crypt::encrypt($randomid),
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
        elseif(session()->has('CAND_LOGIN')){
            return redirect('/');
        }
        else{
            return view('employerregister', $result);
        }
    }
    public function registeremployee(Request $request){
        $result['title'] = 'Register|Employer';
        if(session()->has('ADMIN_LOGIN')){
            return redirect('/');
        }
        elseif(session()->has('CMPY_LOGIN')){
            return redirect('/');
        }
        elseif(session()->has('CAND_LOGIN')){
            return redirect('/');
        }
        else{
            return view('employeeregister', $result);
        }
    }
    public function auth(Request $request){
        $user = $request->post('user');
        $password = $request->post('password');

        $result=Admin::Where(['username'=>$user, 'password'=>$password])->get();
        $result2=Admin::Where(['email'=>$user, 'password'=>$password])->get();
        $result3=Company::Where(['username'=>$user])->get();
        $result4=Company::Where(['email'=>$user])->get();
        $result5=Employee::Where(['username'=>$user])->get();
        $result6=Employee::Where(['email'=>$user])->get();
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
        elseif(isset($result5[0]->id) || isset($result6[0]->id)){

            if(isset($result5[0]->id)){
                if($password == Crypt::decrypt($result5[0]->password)){
                    $request->session()->put('CAND_LOGIN', true);
                    $request->session()->put('CAND_ID', $result5['0']->id);
                    $request->session()->put('CAND_TIME', now());
                }
            }elseif(isset($result6[0]->id)){
                if($password == Crypt::decrypt($result6[0]->password)){
                    $request->session()->put('CAND_LOGIN', true);
                    $request->session()->put('CAND_ID', $result6['0']->id);
                    $request->session()->put('CAND_TIME', now());
                }
            }
            return redirect('candidate/profile');
        }
        else{
            $request->session()->flash('error', 'please enter valid login details');
            return redirect('login');
        }
        
    }
}
