<?php

namespace App\Http\Controllers;

use App\Models\Savecand;
use Illuminate\Http\Request;

class SavecandController extends Controller
{
    public function savecand(Request $request){
        $candid = $request->post('candid');
        $cmpyid = $request->post('cmpyid');
        $savedcand = Savecand::where(['candid'=>$candid, 'cmpyid'=>$cmpyid])->get();
        if(isset($savedcand[0]->id)){
         Savecand::where(['candid'=>$candid, 'cmpyid'=>$cmpyid])->delete();
         return ['pw'=>'Candidate Unsaved!'];
        }
        else
        {
         Savecand::insert([
             'candid'=>$candid,
             'cmpyid'=>$cmpyid,
         ]);
         return ['pw'=>'Candidate Saved!'];
        }
    }
    public function savedcand(Request $request)
    {
     $result['savedcand'] = Savecand::where('cmpyid',session()->get('CMPY_ID'))->get();
     return view('company/savedcandidates',$result);
    }
    public function unsavecand(Request $request){
     $candid = $request->post('candid');
     $cmpyid = $request->post('cmpyid');
      Savecand::where(['candid'=>$candid, 'cmpyid'=>$cmpyid])->delete();
     return back();
     }
}
