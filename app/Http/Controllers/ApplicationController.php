<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\applied;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function apply(Request $request)
    {
        $candid = $request->post('candid');
        $cmpyid = $request->post('cmpyid');
        $jobid = $request->post('jobid');
        $date = date('Y-m-d');
        $proposal = $request->post('proposal');

        Application::insert([
            'candid'=>$candid,
            'cmpyid'=>$cmpyid,
            'jobid'=>$jobid,
            'date'=>$date,
            'proposal'=>$proposal,
        ]);
        $user = Company::find($cmpyid);
        Notification::send($user, new applied($candid,$cmpyid,$jobid));
        return redirect('candidate/appliedjobs');
        
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
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
