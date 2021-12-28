<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
   public function cmpymsgs(Request $request, $candid){
        $result['chats'] = Chat::where(['sid'=>session()->get('CMPY_ID'),'rid'=>$candid])->orWhere(function($query) use ($candid) {
            $query->where(['rid'=>session()->get('CMPY_ID'),'sid'=>$candid]);
        })->get();
        $result['chaters'] = DB::table('chats as m') 
        -> select('m.*') 
        ->where(['m.sid'=>session()->get('CMPY_ID')])->orWhere(['m.rid'=>session()->get('CMPY_ID')])
        ->leftJoin('chats as m1', function($join) {
        $join -> on('m.extra1', '=', 'm1.extra1') 
        -> whereRaw(DB::raw('m.created_at < m1.created_at'));
        }) 
        -> whereNull('m1.extra1') 
        -> orderBy('m.created_at', 'DESC')
        ->groupBy('m.extra1') 
        -> get();
        $result['active'] = $candid;
       return view('company/chatspc', $result);
   }
   public function cmpymsgphone(Request $request, $candid)
    {
        $result['chats'] = Chat::where(['sid'=>session()->get('CMPY_ID'),'rid'=>$candid])->orWhere(function($query) use ($candid) {
            $query->where(['rid'=>session()->get('CMPY_ID'),'sid'=>$candid]);
        })->get();
        $result['cand2'] = Employee::where('id',$candid)->first();
        return view('company/chatmsg',$result);
    }
    public function addchatcmpy(Request $request)
    {
        $sid = $request->post('sid');
        $sty = $request->post('sty');
        $rid = $request->post('rid');
        $rty = $request->post('rty');
        $msg = $request->post('msg');
        $cid = $request->post('cid');

        Chat::insert([
            'sid'=>$sid,
            'sty'=>$sty,
            'rid'=>$rid,
            'rty'=>$rty,
            'msg'=>$msg,
            'extra1'=>$cid,
            'created_at'=>now(),
        ]);
    }
    public function chatlistcmpy(Request $request){
        $result['chaters'] = DB::table('chats as m') 
        -> select('m.*') 
        ->where(['m.sid'=>session()->get('CMPY_ID')])->orWhere(['m.rid'=>session()->get('CMPY_ID')])
        ->leftJoin('chats as m1', function($join) {
        $join -> on('m.extra1', '=', 'm1.extra1') 
        -> whereRaw(DB::raw('m.created_at < m1.created_at'));
        }) 
        -> whereNull('m1.extra1') 
        -> orderBy('m.created_at', 'DESC')
        ->groupBy('m.extra1') 
        -> get();
        return view('company/chatlist',$result);
    }
   public function candmsgs($cmpyid){
    $result['chats'] = Chat::where(['sid'=>session()->get('CAND_ID'),'rid'=>$cmpyid])->orWhere(function($query) use ($cmpyid) {
        $query->where(['rid'=>session()->get('CAND_ID'),'sid'=>$cmpyid]);
    })->get();
    $result['chaters'] = DB::table('chats as m') 
        -> select('m.*') 
        ->where(['m.sid'=>session()->get('CAND_ID')])->orWhere(['m.rid'=>session()->get('CAND_ID')])
        ->leftJoin('chats as m1', function($join) {
        $join -> on('m.extra1', '=', 'm1.extra1') 
        -> whereRaw(DB::raw('m.created_at < m1.created_at'));
        }) 
        -> whereNull('m1.extra1') 
        -> orderBy('m.created_at', 'DESC')
        ->groupBy('m.extra1') 
        -> get();
    $result['active'] = $cmpyid;
   return view('employee/chatspc', $result);
    }
    
    public function candmsgphone(Request $request, $cmpyid)
    {
        $result['chats'] = Chat::where(['sid'=>session()->get('CAND_ID'),'rid'=>$cmpyid])->orWhere(function($query) use ($cmpyid) {
            $query->where(['rid'=>session()->get('CAND_ID'),'sid'=>$cmpyid]);
        })->get();
        $result['cmpy2'] = Company::where('id',$cmpyid)->first();
        return view('employee/chatmsg',$result);
    }
    
    public function addchatcand(Request $request)
    {
        $sid = $request->post('sid');
        $sty = $request->post('sty');
        $rid = $request->post('rid');
        $rty = $request->post('rty');
        $msg = $request->post('msg');
        $cid = $request->post('cid');
        

        Chat::insert([
            'sid'=>$sid,
            'sty'=>$sty,
            'rid'=>$rid,
            'rty'=>$rty,
            'msg'=>$msg,
            'extra1'=>$cid,
            'created_at'=>now(),
        ]);
    }
    public function chatlistcand(Request $request){
        $result['chaters'] = DB::table('chats as m') 
        -> select('m.*') 
        ->where(['m.sid'=>session()->get('CAND_ID')])->orWhere(['m.rid'=>session()->get('CAND_ID')])
        ->leftJoin('chats as m1', function($join) {
        $join -> on('m.extra1', '=', 'm1.extra1') 
        -> whereRaw(DB::raw('m.created_at < m1.created_at'));
        }) 
        -> whereNull('m1.extra1') 
        -> orderBy('m.created_at', 'DESC')
        ->groupBy('m.extra1') 
        -> get();
        return view('employee/chatlist',$result);
    }
}
