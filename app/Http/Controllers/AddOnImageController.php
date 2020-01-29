<?php

namespace App\Http\Controllers;

use App\Add_on_Image;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddOnImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query=Add_on_Image::where('addon_id', 0)->where('user_id', Auth::user()->id);
        if($request->input('id')){
            $query=$query->orWhere('addon_id',$request->input('id'));
        }
        return  ImageResource::collection($query->get());
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
        $this->validate($request, [
            'image' => 'required|image'
        ]);

       $location = $request->image->store('addon_images');
       Add_on_Image::create([
           'addon_id' => 0,
           'user_id' => Auth::user()->id,
           'location' => $location
       ]);

       return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Add_on_Image  $add_on_Image
     * @return \Illuminate\Http\Response
     */
    public function show(Add_on_Image $add_on_Image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Add_on_Image  $add_on_Image
     * @return \Illuminate\Http\Response
     */
    public function edit(Add_on_Image $add_on_Image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Add_on_Image  $add_on_Image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Add_on_Image $add_on_Image)
    {
        //
        $this->validate($request, [
            'image' => 'required|image'
        ]);

       $location = $request->image->store('addon_images');
       $add_on_Image->update([
           'addon_id' => 0,
           'user_id' => Auth::user()->id,
           'location' => $location
       ]);
       $add_on_Image->save();

       return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Add_on_Image  $add_on_Image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Add_on_Image $add_on_Image)
    {
        //
        $addon_image = Add_on_Image::findOrFail($add_on_Image);
        $addon_image->delete();
        return response()->json('successfully deleted');
    }
}
