<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Crypt;
use Illuminate\Support\Facades\File;
use App\Mail\emailverify;
use Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userid = session()->get('CMPY_ID');
        $company = Company::where('id',$userid)->get();
        return view('company/cmpyprofile', compact('company'));
    }
    public function cmpy(Request $request){
        $userid = session()->get('CMPY_ID');
        $company = Company::where('id',$userid)->get();
        return response()->json(['company'=>$company]);
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
                Mail::to($email)->send(new emailverify($data));
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
    public function verify(Request $request,$user){
        $username = Crypt::decrypt($user);
        $user = Company::where('username',$username)->get();

        if($user['0']->emailverification == 'verified'){
            echo'<h1>The Link has expired</h1>';
        }
        else{
            Company::where('username',$username)->update([
                'emailverification'=>'verified',
            ]);
            return redirect('company/loginregister/'.$username);
        }

    }
    public function cmpupdate(Request $request){
        $ml = $request->post('mainlocation');
        $about = $request->post('about');
        $overview = $request->post('overview');
        $website = $request->post('website');
        $size = $request->post('cmpysize');
        $estd = $request->post('cmpyestd');
        $id = $request->post('id');

        Company::where('id',$id)->update([
            'website'=>$website,
            'about'=>$about,
            'overview'=>$overview,
            'mainlocation'=>$ml,
            'cmpysize'=>$size,
            'cmpyestd'=>$estd,
        ]);
    }
    public function cmpupdatecp(Request $request){
    
        // echo 'hello';
        $request->validate([
            'coverpic'=>'image|mimes:jpeg,png,jpg,svg'
        ]);
        $id=$request->post('id');
        if($request->hasFile('coverpic')){
            $path='company/cp/'.$request->post('oldimg');
            $file = $request->file('coverpic');
            $ext = $file->getClientOriginalExtension();
            $image_name = time().'cmpycp'.'.'.$ext;
            $file->move('company/cp/',$image_name);
            $image = $image_name;
            Company::where('id', $id)->update([
                'cmpycp'=>$image,
            ]);
            if(File::exists($path)) {
                File::delete($path);
            }
        }
    }
    public function cmpupdatedp(Request $request){
    
        // echo 'hello';
        $request->validate([
            'dp'=>'image|mimes:jpeg,png,jpg,svg'
        ]);
        $id=$request->post('id');
        if($request->hasFile('dp')){
            $path='company/dp/'.$request->post('olddp');
            $file = $request->file('dp');
            $ext = $file->getClientOriginalExtension();
            $image_name = time().'cmpydp'.'.'.$ext;
            $image_resize = Image::make($file->getRealPath());
            $image_resize->fit(300);
            $image_resize->save(public_path('company/dp/'.$image_name));
            $image = $image_name;
            Company::where('id', $id)->update([
                'cmpydp'=>$image,
            ]);
            if(File::exists($path)) {
                File::delete($path);
            }
        }
    }
    public function settings(Request $request){
        $userid = session()->get('CMPY_ID');
        $company = Company::where('id',$userid)->get();
        return view('company/accountsettings', compact('company'));
    }

    public function cmpadminverify(Request $request){
        $id = $request->post('id');
        $av = $request->post('adminverify');
        if($av == NULL){
            $av2 = '';
        }
        else{
            $av2 = 'verified';
        }
        Company::where('id',$id)->update([
            'adminverification'=>$av2,
        ]);
        return back();
    }
    public function cmpupdatename(Request $request){
        $id = $request->post('id');
        $password = $request->post('password');
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $company = Company::where('id',$id)->get();
        if(Crypt::decrypt($company['0']->password) === $password){
            Company::where('id',$id)->update([
                'firstname'=>$firstname,
                'lastname'=>$lastname,
            ]);
            return ['pw'=>'Name Has Been Changed'];
        }
        else{
            return ['pw'=>'Incorrect Password'];
        }
    }
    public function cmpupdateun(Request $request){
        $id = $request->post('id');
        $password = $request->post('password');
        $username = $request->post('username');
        $company = Company::where('id',$id)->get();
        if(Crypt::decrypt($company['0']->password) === $password){
            Company::where('id',$id)->update([
                'username'=>$username,
            ]);
            return ['pw'=>'Username Has Been Changed'];
        }
        else{
            return ['pw'=>'Incorrect Password'];
        }
    }
    public function cmpupdatecn(Request $request){
        $id = $request->post('id');
        $password = $request->post('password');
        $cmpyname = $request->post('cmpyname');
        $company = Company::where('id',$id)->get();
        if(Crypt::decrypt($company['0']->password) === $password){
            Company::where('id',$id)->update([
                'cmpyname'=>$cmpyname,
            ]);
            return ['pw'=>'Company name Has Been Changed'];
        }
        else{
            return ['pw'=>'Incorrect Password'];
        }
    }
    public function cmpupdatepw(Request $request){
        $id = $request->post('id');
        $password = $request->post('password');
        $newpassword = $request->post('newpassword');
        $newpassword2 = $request->post('newpassword2');
        $company = Company::where('id',$id)->get();
        if(Crypt::decrypt($company['0']->password) === $password){
            if($newpassword === $newpassword2){
                Company::where('id',$id)->update([
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
