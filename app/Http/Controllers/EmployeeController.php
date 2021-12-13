<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailcdverify;
use Crypt;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(session()->has('CAND_LOGIN')){
            return view('employee/candprofile');
        }
        else{
            return redirect('login');
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'username'=>'required|unique:admins,username|unique:companies,username|unique:employees,username',
            'email'=>'required|unique:admins,email|unique:companies,email|unique:employees,email',
            'phonenumber'=>'required|numeric|digits_between:10,10',
        ]);
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $username = $request->post('username');
        $phonenumber = $request->post('phonenumber');
        $password = $request->post('password');
        $password2 = $request->post('confirm-password');
        $agree = $request->post('agree');
        $randid = rand(1111111111,999999999999999);

        if($password == $password2 && $agree == 'on'){

            $success = Employee::insert([
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'email'=>$email,
                    'username'=>$username,
                    'phonenumber'=>$phonenumber,
                    'password'=>Crypt::encrypt($password),
                    'extra1'=>Crypt::encrypt($randid),
                ]);
            if($success){
                $data=['name'=>$firstname, 'verifylink'=>Crypt::encrypt($username), 'randid'=>Crypt::encrypt($randid)];
                Mail::to($email)->send(new emailcdverify($data));
            }
            
            
        }

    }
    public function verify(Request $request,$usernm,$ri){
        $username = Crypt::decrypt($usernm);
        $user = Employee::where('username',$username)->get();

        if($user['0']->emailverification == 'verified'){
            echo'<h1>The Link has expired</h1>';
        }
        else{
            if(Crypt::decrypt($user['0']->extra1) == Crypt::decrypt($ri)){
                Employee::where('username',$username)->update([
                    'emailverification'=>'verified',
                    'extra1'=>Crypt::encrypt(rand(1111111111,999999999999999)),
                ]);
                return redirect('candidate/loginregister/'.$username);
            }
           else{
            echo'<h1>The Link has expired</h1>';
           }
        }

    }
    public function registerlogin(Request $request, $username){
        $result = Employee::where('username',$username)->get();
        if(isset($result[0]->id) || isset($result2[0]->id)){
            $request->session()->put('CAND_LOGIN', true);
            if(isset($result[0]->id)){
                $request->session()->put('CAND_ID', $result['0']->id);
            }else{
                $request->session()->put('CAND_ID', $result2['0']->id);
            }
            $request->session()->put('CAND_TIME', now());
            return redirect('/candidate/profile');
            echo 'successful';
        }
        else{
            $request->session()->flash('error', 'please enter valid login details');
            return redirect('login');
        }
        
    }
    public function logout(Request $request)
    {
        session()->forget('CAND_LOGIN');
        session()->forget('CAND_ID');
        session()->forget('CAND_TIME');

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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
