<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin/edithome');
    }
    public function addslider(Request $request){
    
        $request->validate([
            'sliderimage'=>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $text1=$request->post('text1');
        $text2=$request->post('text2');
        if($request->hasFile('sliderimage')){
            $file = $request->file('sliderimage');
            $ext = $file->getClientOriginalExtension();
            $image_name = time().'slider'.'.'.$ext;
            $file->move('assets/slider/',$image_name);
            $image = $image_name;
        }
        
           
        Home::insert([
            'section'=>'slider',
            'text1'=>$text1,
            'text2'=>$text2,
            'image'=>$image,
         ]);

       
    }
    public function getslider(){
        $sliders = Home::where('section','slider')->orderBy('contorder','ASC')->get();
        return response()->json(['sliders'=>$sliders]);
    }
    public function editslider($id){
        $slider = Home::find($id);
        if($slider){
            return response()->json([
                'status'=>200,
                'slider'=>$slider
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Admin Not Found'
            ]);
        }
    }
    public function updateslider(Request $request){
    
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg,svg'
        ]);
        $text1=$request->post('text1');
        $text2=$request->post('text2');
        $contorder=$request->post('contorder');
        $id=$request->post('id');
        if($request->hasFile('sliderimage')){
            $path='assets/slider/'.$request->post('oldimg');
            $file = $request->file('sliderimage');
            $ext = $file->getClientOriginalExtension();
            $image_name = time().'slider'.'.'.$ext;
            $file->move('assets/slider/',$image_name);
            $image = $image_name;
            Home::where('id', $id)->update([
                'image'=>$image,
            ]);
            if(File::exists($path)) {
                File::delete($path);
            }
        }
        Home::where('id',$id)->update([
            'text1'=>$text1,
            'text2'=>$text2,
            'contorder'=>$contorder,
        ]);
    
    }
    public function deleteslider(Request $request){
        $id=$request->post('id');
        $path='assets/slider/'.$request->post('image');
        if(File::exists($path)) {
            File::delete($path);
        }
        $model=Home::where(['id'=>$id]);
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
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }
}
