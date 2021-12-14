<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailcdverify;
use App\Mail\emailchange;
use App\Mail\cmpdeactivate;
use App\Mail\cmpreactivate;
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
            $result['cand'] = Employee::where('id',session()->get('CAND_ID'))->first();
            return view('employee/candprofile', $result);
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

    public function settings(Request $request)
    {
        $id = session()->get('CAND_ID');
        $result['cand'] = Employee::where('id',$id)->first(); 
        return view('employee/accountsettings',$result);
    }
    public function getcandidate(Request $request){
        $id = session()->get('CAND_ID');
        $cand = Employee::where('id',$id)->first(); 
        return response()->json(['candidate'=>$cand]);
        // dd($cand);
    }
    public function candupdatename(Request $request){
        $id = $request->post('id');
        $gid = $request->post('gid');
        $password = $request->post('password');
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $cand = Employee::where('id',$id)->get();
        if($gid == NULL)
        { 
            if(Crypt::decrypt($cand['0']->password) === $password){
                Employee::where('id',$id)->update([
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                ]);
                return ['pw'=>'Name Has Been Changed'];
            }
            else{
                return ['pw'=>'Incorrect Password'];
            }
        }
        else{
            Employee::where('id',$id)->update([
                'firstname'=>$firstname,
                'lastname'=>$lastname,
            ]);
            return ['pw'=>'Name Has Been Changed'];
        }
        
    }
    public function candupdateun(Request $request){
        $request->validate([
            'username'=>'required|unique:admins,username|unique:companies,username',
        ]);
        $id = $request->post('id');
        $password = $request->post('password');
        $username = $request->post('username');
        $cand = Employee::where('id',$id)->get();
        if(Crypt::decrypt($cand['0']->password) === $password){
            Employee::where('id',$id)->update([
                'username'=>$username,
            ]);
            return ['pw'=>'Username Has Been Changed'];
        }
        else{
            return ['pw'=>'Incorrect Password'];
        }
    }
    public function candupdateemail(Request $request){
        // $request->validate([
        //     'email'=>'required|unique:admins,email|unique:companies,email',
        // ]);
        $id = $request->post('id');
        $password = $request->post('password');
        $email = $request->post('email');
        $cand = Employee::where('id',$id)->get();
        $randomid = rand(111111111111111,999999999999999);
        if(Crypt::decrypt($cand['0']->password) === $password){
           
            $username = Crypt::encrypt($cand[0]->username);
            $data=['name'=>$cand[0]->firstname, 'verifylink'=>'cd/'.Crypt::encrypt($username), 'randomid'=>Crypt::encrypt($randomid)];
            $success = Mail::to($email)->send(new emailchange($data));
                
            if(Mail::failures()){ 
                return back();
            }
            else{
                Employee::where('id',$id)->update([
                    'email'=>$email,
                    'emailverification'=>'',
                    'extra1'=>$randomid
                ]);
                return redirect('/');
            }
        }
        else{
            return back();
        }
    }
    public function emailchange(Request $request, $un,$ri){
        $user = Crypt::decrypt($un);
        $username = Crypt::decrypt($user);
        $randomid = Crypt::decrypt($ri);
        $cand = Employee::where('username',$username)->get();
        if($cand[0]->extra1 == $randomid){
            Employee::where('username',$username)->update([
                'emailverification'=>'verified',
                'extra1'=>Crypt::encrypt($ri).rand(1111111111,9999999999),
            ]);
            return redirect('/');
        }
        else{
            echo 'The Link has already expired';
        }
        // echo 'success';
    }
    public function candupdatepw(Request $request){
        $id = $request->post('id');
        $password = $request->post('password');
        $newpassword = $request->post('newpassword');
        $newpassword2 = $request->post('newpassword2');
        $cand = Employee::where('id',$id)->get();
        if(Crypt::decrypt($cand['0']->password) === $password){
            if($newpassword === $newpassword2){
                Employee::where('id',$id)->update([
                    'password'=>Crypt::encrypt($newpassword),
                ]);
                return ['pw'=>'Password Has Been Changed'];
            }
            else
            {
                return ['pw'=>'The New Passwords Do not match'];
            }      
        }
        else{
            return ['pw'=>'Incorrect Password'];
        }
    }
    public function candupdatepn(Request $request){
        $request->validate([
            'phonenumber'=>'required|numeric|digits_between:10,10',
        ]);
        $id = $request->post('id');
        $password = $request->post('password');
        $phonenumber = $request->post('phonenumber');
        $company = Employee::where('id',$id)->get();
        if(Crypt::decrypt($company['0']->password) === $password){
            Employee::where('id',$id)->update([
                'phonenumber'=>$phonenumber,
            ]);
            return ['pw'=>'Phone number Has Been Changed'];
        }
        else{
            return ['pw'=>'Incorrect Password'];
        }
    }
    public function canddeactivate(Request $request)
    {
        $id = $request->post('id');
        $gid = $request->post('gid');
        $password = $request->post('password');
        $reason = $request->post('reason');
        $cand = Employee::where('id',$id)->get();
        $randid = rand(111111111111111,999999999999999);
        if($gid == NULL)
        {
            if(Crypt::decrypt($cand[0]->password) === $password){
                $success = Employee::where('id',$id)->update([
                    'extra1'=>Crypt::encrypt($randid),
                    'extra3'=>$reason,
                ]);
              if($success){
                  $username = Crypt::encrypt($cand[0]->username);
                  $data=['name'=>$cand[0]->firstname, 'deactivatelink'=>'cd/'.Crypt::encrypt($cand[0]->username), 'randomid'=>Crypt::encrypt(Crypt::encrypt($randid))];
                  Mail::to($cand[0]->email)->send(new cmpdeactivate($data));
              }
              return ['pw'=>'Check Your email to deactivate your account'];
          }
          else{
              return ['pw'=>'Incorrect Password'];
          }
        }
        else{
            $success = Employee::where('id',$id)->update([
                'extra1'=>Crypt::encrypt($randid),
                'extra3'=>$reason,
            ]);
          if($success){
              $username = Crypt::encrypt($cand[0]->username);
              $data=['name'=>$cand[0]->firstname, 'deactivatelink'=>'cd/'.Crypt::encrypt($cand[0]->username), 'randomid'=>Crypt::encrypt(Crypt::encrypt($randid))];
              Mail::to($cand[0]->email)->send(new cmpdeactivate($data));
          }
          return ['pw'=>'Check Your email to deactivate your account'];
        }
        
    }
    public function confirmda(Request $request,$un,$ri){
        $username = Crypt::decrypt($un);
        $randid = Crypt::decrypt($ri);
        $randomid = Crypt::decrypt($randid);
        $cand = Employee::where('username',$username)->get();
        if(Crypt::decrypt($cand[0]->extra1) == $randomid){
            Employee::where('username',$username)->update([
                'deactivate'=>'on',
                'extra1'=>Crypt::encrypt($ri).rand(1111111111,9999999999),
            ]);
            return redirect('candidate/logout');
        }
        else{
            echo 'The Link has already expired';
        }
    }
    public function candreactivate(Request $request)
    {
        $id = $request->post('id');
        $cand = Employee::where('id',$id)->get();
        $randid = rand(111111111111111,999999999999999);
        
              $success = Employee::where('id',$id)->update([
                  'extra1'=>Crypt::encrypt($randid),
                  'extra3'=>'',
              ]);
            if($success){
                $username = Crypt::encrypt($cand[0]->username);
                $data=['name'=>$cand[0]->firstname, 'reactivatelink'=>'cd/'.Crypt::encrypt($cand[0]->username), 'randomid'=>Crypt::encrypt(Crypt::encrypt($randid))];
                Mail::to($cand[0]->email)->send(new cmpreactivate($data));
            }
            return ['pw'=>'Check Your email to reactivate your account'];
    }
    public function confirmra(Request $request,$un,$ri){
        $username = Crypt::decrypt($un);
        $randid = Crypt::decrypt($ri);
        $randomid = Crypt::decrypt($randid);
        $cand = Employee::where('username',$username)->get();
        if(Crypt::decrypt($cand[0]->extra1) == $randomid){
            Employee::where('username',$username)->update([
                'deactivate'=>'',
                'extra1'=>Crypt::encrypt($ri).rand(1111111111,9999999999),
            ]);
            return redirect('/');
        }
        else{
            echo 'The Link has already expired';
        }
    }
    public function logout(Request $request)
    {
        session()->forget('CAND_LOGIN');
        session()->forget('CAND_ID');
        session()->forget('CAND_TIME');

        return redirect('/');
    }

    public function taedit(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $about = $request->post('about');

        Employee::where('id',$id)->update([
            'title'=>$title,
            'about'=>$about,
        ]);
    }
    public function skilledit(Request $request)
    {
        $id = $request->post('id');
       $skill = $request->post('skill',[]);
       $sl = $request->post('sl',[]);

       Employee::where('id',$id)->update([
           'skills'=>implode('|',$skill),
           'skillslevel'=>implode('|',$sl),
       ]);
       return back();
    }
    public function educationedit(Request $request){
        $id = $request->post('id');
        $insname = $request->post('insname',[]);
        $inscourse = $request->post('inscourse',[]);
        $frommonth = $request->post('frommonth',[]);
        $fromyear = $request->post('fromyear',[]);
        $tomonth = $request->post('tomonth',[]);
        $toyear = $request->post('toyear',[]);

        Employee::where('id',$id)->update([
            'eduorganization'=>implode('|',$insname),
            'educourse'=>implode('|',$inscourse),
            'edutimefrommonth'=>implode('|',$frommonth),
            'edutimefromyear'=>implode('|',$fromyear),
            'edutimetomonth'=>implode('|',$tomonth),
            'edutimetoyear'=>implode('|',$toyear),
        ]);
        return back();
    }
}
