<?php

namespace App\Http\Controllers;
use Socialite;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Admin;
use Crypt;

use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallBack(Request $request){
        $user = Socialite::driver('google')->stateless()->user();

        $user2 = Employee::where('google_id',$user->id)->first();

        // dd($user);

        if(!empty($user2)){
                    $request->session()->put('CAND_LOGIN', true);
                    $request->session()->put('CAND_ID', $user2->id);
                    $request->session()->put('CAND_TIME', now());
                    return redirect('candidate/profile');
        }
        else{
                $admin = Admin::where('email',$user->email)->first();
                $cmpy = Company::where('email',$user->email)->first();
                $cand = Employee::where('email',$user->email)->first();
                if(!empty($admin))
                {
                    $result['title'] = 'Google Error';
                    return view('googlerror',$result);
                }
                elseif(!empty($cmpy))
                {
                    $result['title'] = 'Google Error';
                    return view('googlerror',$result);
                }
                elseif(!empty($cand))
                {
                    $result['title'] = 'Google Error';
                    return view('googlerror',$result);
                }
                else{
                    Employee::insert([
                        'firstname'=>$user->user['given_name'],
                        'lastname'=>$user->user['family_name'],
                        'email'=>$user->email,
                        'username'=>$user->email,
                        'password'=>Crypt::encrypt(rand(1111,9999999)),
                        'google_id'=>$user->id,
                        'emailverification'=>'verified',
                        'extra1'=>Crypt::encrypt(rand(1111111111,999999999999999))
                    ]);
                    $new = Employee::where('google_id',$user->id)->first();
                    $request->session()->put('CAND_LOGIN', true);
                    $request->session()->put('CAND_ID', $new->id);
                    $request->session()->put('CAND_TIME', now());
                    return redirect('candidate/profile');
                }

        }
    }

}
