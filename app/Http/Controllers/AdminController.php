<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return view('admin/layoutadmin');
        }
        else{
            return redirect('/');
        }
        return redirect('/');
    }
    public function admin(Request $request)
    {
       
        return view('admin/admins');
    }
    public function logout(Request $request)
    {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->forget('ADMIN_TIME');

        return redirect('/');
    }
    public function addadmin(Request $request){
    
        $request->validate([
            'username'=>'required|unique:admins,username,',
            'email'=>'required|unique:admins,email,',
        ]);
        $name=$request->post('name');
        $username=$request->post('username');
        $email=$request->post('email');
        $role=$request->post('role');
        $password=$request->post('password');

        Admin::insert([
            'name'=>$name,
            'username'=>$username,
            'email'=>$email,
            'role'=>$role,
            'password'=>$password,
        ]);
        return response()->json(['success'=>'Contact form submitted successfully']);
    }
    public function updateadmin(Request $request){
    
        $name=$request->post('name');
        $username=$request->post('username');
        $email=$request->post('email');
        $role=$request->post('role');
        $password=$request->post('password');
        $id=$request->post('id');

        Admin::where('id',$id)->update([
            'name'=>$name,
            'username'=>$username,
            'email'=>$email,
            'role'=>$role,
            'password'=>$password,
        ]);
    
    }
    public function deleteadmin(Request $request){
        $id=$request->post('id');
        $model=Admin::where(['id'=>$id]);
        $model->delete();
    }
    public function getadmin(){
        $admins = Admin::all();
        return response()->json(['admins'=>$admins]);
    }
    public function editadmin($id){
        $admin = Admin::find($id);
        if($admin){
            return response()->json([
                'status'=>200,
                'admin'=>$admin
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Admin Not Found'
            ]);
        }
    }
    public function company(Request $request)
    {
        $result['company']=Company::orderBy('adminverification','asc')->get();
        return view('admin/company', $result);
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
