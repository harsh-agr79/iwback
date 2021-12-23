<?php

namespace App\Http\Controllers;

use App\Models\Savecmpy;
use Illuminate\Http\Request;

class SavecmpyController extends Controller
{
   public function savecmpy(Request $request){
       $candid = $request->post('candid');
       $cmpyid = $request->post('cmpyid');
       $savedcmpy = Savecmpy::where(['candid'=>$candid, 'cmpyid'=>$cmpyid])->get();
       if(isset($savedcmpy[0]->id)){
        Savecmpy::where(['candid'=>$candid, 'cmpyid'=>$cmpyid])->delete();
        return ['pw'=>'Company Unsaved!'];
       }
       else
       {
        Savecmpy::insert([
            'candid'=>$candid,
            'cmpyid'=>$cmpyid,
        ]);
        return ['pw'=>'Company Saved!'];
       }
   }
   public function savedcmpy(Request $request)
   {
    $result['savedcmpy'] = Savecmpy::where('candid',session()->get('CAND_ID'))->get();
    return view('employee/savedcompanies',$result);
   }
   public function unsavecmpy(Request $request){
    $candid = $request->post('candid');
    $cmpyid = $request->post('cmpyid');
     Savecmpy::where(['candid'=>$candid, 'cmpyid'=>$cmpyid])->delete();
    return back();
    }
}
