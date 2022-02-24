<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $result['contact']= Contact::orderBy('id', 'DESC')->get();
        return view('admin/contact', $result);
    }
    public function contactform(){
        $result['title'] = 'Contact Us';
        if(session()->has('CMPY_LOGIN')){
            $result['user'] = Company::where('id',session()->get('CMPY_ID'))->get();
        }
        if(session()->has('CAND_LOGIN')){
            $result['user'] = Employee::where('id',session()->get('CAND_ID'))->get();
        }
        return view('/contactform', $result);
    }
    public function contactmsg(Request $request)
    {
        Contact::insert([
            'name'=>$request->post('name'),
            'type'=>$request->post('type'),
            'email'=>$request->post('email'),
            'phone'=>$request->post('phone'),
            'message'=>$request->post('message'),
        ]);
        $request->session()->flash('error', 'Message has been sent');
        return redirect('/contact');
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
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
