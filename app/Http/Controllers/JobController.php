<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Sector;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
// use Illuminate\Contracts\Pagination\Presenter;
use App\Notifications\shortlisted;
use App\Notifications\hired;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userid = session()->get('CMPY_ID');
        $result['company'] = Company::where('id',$userid)->get();
        $result['sector'] = Sector::all();
        return view('company/postajob', $result);
    }

    public function postjob(Request $request)
    {
            $title = $request->post('title');
            $type=$request->post('type');
            $sector=$request->post('sector');
            $branchlocation=$request->post('branches');
            $duration=$request->post('duration');
            $deadline=$request->post('deadline');
            $wbs=$request->post('work-based-stipend');
            $salary = $request->post('salary');

            if($wbs === NULL)
            {
                $stipend = $salary;
            }
            else
            {
                $stipend = $wbs;
            }
            $jobid ='job'.$request->post('cmpyid').time();
            $orientation=$request->post('orientation');
            $cmpyname=$request->post('cmpyname');
            $cmpyemail=$request->post('cmpyemail');
            $cmpyid=$request->post('cmpyid');
            $cmpyusername=$request->post('cmpyusername');
            $cmpyabout=$request->post('cmpyabout');
            $website=$request->post('website');
            $aboutjob=$request->post('aboutjob');
            $skills = $request->post('skill',[]);
            $jobrequirements=$request->post('jobrequirements');
            $perks=$request->post('perk',[]);
            $openings=$request->post('openings');
            $experience=$request->post('experience');

        Job::insert([
            'title'=>$title,
            'type'=>$type,
            'sector'=>$sector,
            'branchlocation'=>$branchlocation,
            'duration'=>$duration,
            'deadline'=>$deadline,
            'stipend'=>$stipend,
            'jobid'=>$jobid,
            'orientation'=>$orientation,
            'cmpyname'=>$cmpyname,
            'cmpyemail'=>$cmpyemail,
            'cmpyid'=>$cmpyid,
            'cmpyusername'=>$cmpyusername,
            'cmpyabout'=>$cmpyabout,
            'website'=>$website,
            'aboutjob'=>$aboutjob,
            'skills'=>implode('|',$skills),
            'jobrequirements'=>$jobrequirements,
            'perks'=>implode('|',$perks),
            'openings'=>$openings,
            'experience'=>$experience,
        ]);
    }
    public function editjob(Request $request)
    {
            $title = $request->post('title');
            $type=$request->post('type');
            $sector=$request->post('sector');
            $branchlocation=$request->post('branches');
            $duration=$request->post('duration');
            $deadline=$request->post('deadline');
            $wbs=$request->post('work-based-stipend');
            $salary = $request->post('salary');

            if($wbs === NULL)
            {
                $stipend = $salary;
            }
            else
            {
                $stipend = $wbs;
            }
            $jobid = $request->post('jobid');
            $orientation=$request->post('orientation');
            $cmpyname=$request->post('cmpyname');
            $cmpyemail=$request->post('cmpyemail');
            $cmpyid=$request->post('cmpyid');
            $cmpyusername=$request->post('cmpyusername');
            $cmpyabout=$request->post('cmpyabout');
            $website=$request->post('website');
            $aboutjob=$request->post('aboutjob');
            $skills = $request->post('skill',[]);
            $jobrequirements=$request->post('jobrequirements');
            $perks=$request->post('perk',[]);
            $openings=$request->post('openings');
            $experience=$request->post('experience');
            $id = $request->post('id');

        Job::where('id',$id)->update([
            'title'=>$title,
            'type'=>$type,
            'sector'=>$sector,
            'branchlocation'=>$branchlocation,
            'duration'=>$duration,
            'deadline'=>$deadline,
            'stipend'=>$stipend,
            'jobid'=>$jobid,
            'orientation'=>$orientation,
            'cmpyname'=>$cmpyname,
            'cmpyemail'=>$cmpyemail,
            'cmpyid'=>$cmpyid,
            'cmpyusername'=>$cmpyusername,
            'cmpyabout'=>$cmpyabout,
            'website'=>$website,
            'aboutjob'=>$aboutjob,
            'skills'=>implode('|',$skills),
            'jobrequirements'=>$jobrequirements,
            'perks'=>implode('|',$perks),
            'openings'=>$openings,
            'experience'=>$experience,
        ]);
    }
    public function jobmanager(Request $request)
    {
        $userid = session()->get('CMPY_ID');
        $result['jobs'] = Job::where('cmpyid',$userid)->get();
        return view('company/jobsmanager', $result);
    }
    public function jobdetail(Request $request, $jobid){
        $result['job']=Job::where('jobid',$jobid)->get();
        return view('company/jobdetails', $result);
    }
    public function jobedit(Request $request, $jobid){
        $result['job']=Job::where('jobid',$jobid)->get();
        $result['sector'] = Sector::all();
        return view('company/jobedit', $result);
    }
    public function findjobs(Request $request){
        $result['title']='Find Jobs';
        $result['jobs']=Job::all();
        $result['sector'] = Sector::all();
        return view('employee/findjobs', $result);
    }
    public function candjobdet(Request $request, $jobid){
        $result['job']=Job::where('jobid',$jobid)->get();
        $result['applied']=Application::where('jobid', $jobid)->get();
        return view('employee/jobdet', $result);
    }
    public function managejob(Request $request, $jobid){
        $result['job']=Job::where('jobid',$jobid)->get();
        $id=Job::where('jobid',$jobid)->first();
        $result['applicants'] =Application::where('jobid',$jobid)->get();
        if(session()->get('CMPY_ID') == $id->cmpyid){
            return view('company/managejob', $result);
        }
        else
        {
        return redirect('company/jobsmanager');
        }
    }
    public function shortlist(Request $request)
    {
        $id = $request->post('id');
        $sl = $request->post('sl');
        $candid = $request->post('candid');
        $apli = Application::where('id',$id)->first();
        $jobid = $apli->jobid;
        Application::where('id',$id)->update([
            'shortlist'=>$sl
        ]);
        if($sl == 'on'){
            $cmpyid = session()->get('CMPY_ID');
            $user = Employee::find($candid);
            Notification::send($user, new shortlisted($candid,$cmpyid,$jobid));
        }
        return ['pw'=>$sl];
    }
    public function hire(Request $request)
    {
        $id = $request->post('id');
        $hired = $request->post('hire');
        $candid = $request->post('candid');
        $apli = Application::where('id',$id)->first();
        $jobid = $apli->jobid;
        Application::where('id',$id)->update([
            'hired'=>$hired
        ]);
        if($hired == 'on'){
            $cmpyid = session()->get('CMPY_ID');
            $user = Employee::find($candid);
            Notification::send($user, new hired($candid,$cmpyid,$jobid));
        }
        return back();
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
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
