<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Crypt;
use Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('company/cmpyprofile');
    }
    public function register(Request $request){

        $request->validate([
            'username'=>'required|unique:admins,username|unique:companies,username',
            'email'=>'required|unique:admins,email|unique:companies,email',
            'pancertificate'=>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $cmpyname = $request->post('cmpyname');
        $email = $request->post('email');
        $phonenumber = $request->post('phonenumber');
        $username = $request->post('username');
        $pannumber = $request->post('pannumber');
        $password = $request->post('password');
        $password2 = $request->post('confirm-password');
        $agree = $request->post('agree');
        if($request->hasFile('pancertificate')){
            $file = $request->file('pancertificate');
            $ext = $file->getClientOriginalExtension();
            $image_name = time().'cmpypan'.'.'.$ext;
            $file->move('company/pancertificates/',$image_name);
            $image = $image_name;
        }
        if($password == $password2 && $agree == 'on'){
         $success =  Company::insert([
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'cmpyname'=>$cmpyname,
            'email'=>$email,
            'phonenumber'=>$phonenumber,
            'username'=>$username,
            'pannumber'=>$pannumber,
            'pancertificate'=>$image_name,
            'password'=>Crypt::encrypt($password),
          ]);  
        }
        if($success){
        
                $data=['name'=>$firstname, 'verifylink'=>Crypt::encrypt($username)];
                $user['to']=$email;
                Mail::send('email_verification',$data,function($messages)
                use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Verify Your Email');
                }    
            );
        }

    }

    public function registerlogin(Request $request, $username){
        $result = Company::where('username',$username)->get();
        if(isset($result[0]->id) || isset($result2[0]->id)){
            $request->session()->put('CMPY_LOGIN', true);
            if(isset($result[0]->id)){
                $request->session()->put('CMPY_ID', $result['0']->id);
            }else{
                $request->session()->put('CMPY_ID', $result2['0']->id);
            }
            $request->session()->put('CMPY_TIME', now());
            return redirect('/company/profile');
        }
        else{
            $request->session()->flash('error', 'please enter valid login details');
            return redirect('login');
        }
        
    }
    public function logout(Request $request)
    {
        session()->forget('CMPY_LOGIN');
        session()->forget('CMPY_ID');
        session()->forget('CMPY_TIME');

        return redirect('/');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
