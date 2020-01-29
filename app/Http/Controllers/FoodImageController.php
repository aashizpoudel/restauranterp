<?php

namespace App\Http\Controllers;

use App\Food_Image;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query=Food_Image::where('food_id', 0)->where('user_id', Auth::user()->id);
        if($request->input('id')){
            $query=$query->orWhere('food_id',$request->input('id'));
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

       $location = $request->image->store('food_images');
       Food_Image::create([
           'food_id' => 0,
           'user_id' => Auth::user()->id,
           'location' => $location
       ]);

       return response()->json('success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food_Image  $food_Image
     * @return \Illuminate\Http\Response
     */
    public function show(Food_Image $food_Image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food_Image  $food_Image
     * @return \Illuminate\Http\Response
     */
    public function edit(Food_Image $food_Image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food_Image  $food_Image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food_Image $food_Image)
    {
        //
        $this->validate($request, [
            'image' => 'required|image'
        ]);

       $location = $request->image->store('food_images');
       $food_Image->update([
           'food_id' => 0,
           'user_id' => Auth::user()->id,
           'location' => $location
       ]);
       $food_Image->save();

       return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food_Image  $food_Image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food_Image $food_Image)
    {
        //
        $food_image = Food_Image::findOrFail($food_Image);
        $food_image->delete();
        return response()->json('successfully deleted');
    }
}
