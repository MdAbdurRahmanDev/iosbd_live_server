<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Banner;
use Image;
use Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::where('position', '<>', '4')->latest()->get();
        return view('backend.banner.index',compact('banners'));
    }

    public function instagram()
    {
        $banners = Banner::where('position', 4)->latest()->get();
        return view('backend.banner.instagram.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    }
    public function instagramCreate()
    {
        return view('backend.banner.instagram.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'banner_img' => 'required',
            'position' => 'required'
        ]);

        if($request->hasfile('banner_img')){
            $img = $request->file('banner_img');
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->save('upload/banner/'.$name_gen);
            $save_url = 'upload/banner/'.$name_gen;
        }else{
            $save_url = '';
        }

        $banner = new Banner();
        $banner->title_en = $request->title_en;
        if($request->title_bn == ''){
            $banner->title_bn = $request->title_en;
        }else{
            $banner->title_bn = $request->title_bn;
        }

        $banner->description_en = $request->description_en;
        if($request->description_bn == ''){
            $banner->description_bn = $request->description_en;
        }else{
            $banner->description_bn = $request->description_bn;
        }
        $banner->banner_url = $request->banner_url;
        if($request->status == Null){
            $request->status = 0;
        }
        $banner->status = $request->status;
        $banner->position = $request->position;
        $banner->banner_img = $save_url;
        $banner->created_at = Carbon::now();

        $banner->save();

        if($banner->position == 4){
            Session::flash('success','Gallery Added Successfully');
            return redirect()->route('banner.instagram.index');
        }

        Session::flash('success','Banner Added Successfully');
        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
    	return view('backend.banner.edit',compact('banner'));
    }
    public function instagramEdit($id)
    {
        $banner = Banner::findOrFail($id);
    	return view('backend.banner.instagram.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'position' => 'required'
        ]);

        $banner = Banner::find($id);
        // //banner Photo Update
        if($request->hasfile('banner_img')){
            try {
                if(file_exists($banner->banner_img)){
                    unlink($banner->banner_img);
                }
            } catch (Exception $e) {

            }
            $banner_img = $request->banner_img;
            $banner_save = time().$banner_img->getClientOriginalName();
            $banner_img->move('upload/banner/',$banner_save);
            $banner->banner_img = 'upload/banner/'.$banner_save;
        }else{
           $banner_save = '';
        }

        // banner table update
        $banner->title_en = $request->title_en;
        if($request->title_bn == ''){
            $banner->title_bn = $request->title_en;
        }else{
            $banner->title_bn = $request->title_bn;
        }
        $banner->description_en = $request->description_en;
        if($request->description_bn == ''){
            $banner->description_bn = $request->description_en;
        }else{
            $banner->description_bn = $request->description_bn;
        }
        $banner->banner_url = $request->banner_url;
        if($request->status == Null){
            $request->status = 0;
        }
        $banner->status = $request->status;
        $banner->position = $request->position;

        $banner->update();

        if($banner->position == 4){
            $notification = array(
                'message' => 'Gallery Updated Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('banner.instagram.index');
        }

        $notification = array(
            'message' => 'Banner Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('banner.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        // dd($banner);
        try {
            if(file_exists($banner->banner_img)){
                unlink($banner->banner_img);
            }
        } catch (Exception $e) {

        }

    	$banner->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully.',
            'alert-type' => 'success'
        );
		return redirect()->back()->with($notification);
    }
    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $banner = Banner::find($id);
        $banner->status = 1;
        $banner->save();

        Session::flash('success','Banner Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $banner = Banner::find($id);
        $banner->status = 0;
        $banner->save();

        Session::flash('success','Banner Inactive Successfully.');
        return redirect()->back();
    }
}
