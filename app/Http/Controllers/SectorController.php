<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       return view('admin/sectors');
    }
    public function addsector(Request $request){
    
        $request->validate([
            'sector'=>'required|unique:sectors,sector,',
            'image'=>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $sector=$request->post('sector');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $image_name = time().'sector'.'.'.$ext;
            $file->move('sector/',$image_name);
            $image = $image_name;
        }
        
           
        Sector::insert([
            'sector'=>$sector,
            'sectorimage'=>$image,
         ]);

       
    }
    public function updatesector(Request $request){
    
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $sector=$request->post('sector');
        $sectorshow=$request->post('sectorshow');
        if($sectorshow == NULL){
            $secshow = 'off';
        }
        else{
            $secshow = 'on';
        }
        $id=$request->post('id');
        if($request->hasFile('image')){
            $path='sector/'.$request->post('oldimg');
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $image_name = time().'sector'.'.'.$ext;
            $file->move('sector/',$image_name);
            $image = $image_name;
            Sector::where('id', $id)->update([
                'sectorimage'=>$image,
            ]);
            if(File::exists($path)) {
                File::delete($path);
            }
        }
        Sector::where('id',$id)->update([
            'sector'=>$sector,
            'sectorshow'=>$secshow,
        ]);
    
    }
    public function deletesector(Request $request){
        $id=$request->post('id');
        $path='sector/'.$request->post('image');
        if(File::exists($path)) {
            File::delete($path);
        }
        $model=Sector::where(['id'=>$id]);
        $model->delete();
    }
    public function getsector(){
        $sectors = Sector::all();
        return response()->json(['sectors'=>$sectors]);
    }
    public function editsector($id){
        $sector = Sector::find($id);
        if($sector){
            return response()->json([
                'status'=>200,
                'sector'=>$sector
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Admin Not Found'
            ]);
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
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        //
    }
}
