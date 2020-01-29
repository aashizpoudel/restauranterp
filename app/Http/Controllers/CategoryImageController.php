<?php

namespace App\Http\Controllers;

use App\Category_Image;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;





class CategoryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query=Category_Image::where('category_id', 0)->where('user_id', Auth::user()->id);
        if($request->input('id')){
            $query=$query->orWhere('category_id',$request->input('id'));
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

       $location = $request->image->store('category_images');
       Category_Image::create([
           'category_id' => 0,
           'user_id' => Auth::user()->id,
           'location' => $location
       ]);

       return response()->json('success');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category_Image  $category_Image
     * @return \Illuminate\Http\Response
     */
    public function show(Category_Image $category_Image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category_Image  $category_Image
     * @return \Illuminate\Http\Response
     */
    public function edit(Category_Image $category_Image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category_Image  $category_Image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category_Image $category_Image)
    {
        //
        $this->validate($request, [
            'image' => 'required|image'
        ]);

       $location = $request->image->store('category_images');
       $category_Image->update([
           'category_id' => 0,
           'user_id' => Auth::user()->id,
           'location' => $location
       ]);
       $category_Image->save();

       return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category_Image  $category_Image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category_image = Category_Image::findOrFail($id);
        $category_image->delete();
        return response()->json('successfully deleted');
    }
}
