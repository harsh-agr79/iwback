<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin/skills');
    }
    public function getskill(){
        $skills = Skill::all();
        return response()->json(['skills'=>$skills]);
    }
    public function skillall(){
        $p = Skill::all();
        return response()->json($p);
    }
    public function addskill(Request $request){
        $request->validate([
            'skill'=>'required|unique:skills,skill,',
        ]);
        $skill=$request->post('skill');
        $type=$request->post('type');

        Skill::insert([
            'skill'=>$skill,
            'type'=>$type,
        ]);
    }
    public function editskill($id){
        $skill = Skill::find($id);
        if($skill){
            return response()->json([
                'status'=>200,
                'skill'=>$skill
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Admin Not Found'
            ]);
        }
    }
    public function updateskill(Request $request){
    
        $skill=$request->post('skill');
        $type=$request->post('type');
        $id=$request->post('id');

        Skill::where('id',$id)->update([
            'skill'=>$skill,
            'type'=>$type,
        ]);
    
    }
    public function deleteskill(Request $request){
        $id=$request->post('id');
        $model=Skill::where(['id'=>$id]);
        $model->delete();
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
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
