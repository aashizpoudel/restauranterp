<?php

namespace App\Http\Controllers;

use App\Category;
use App\Category_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Category::latest()->orderBy('id','desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        $status = $row->status;
                        if($status == 0){
                            $status='Inactive';
                        }else{
                            $status='Active';
                        }
                        return $status;
                    })
                    ->addColumn('image', function($row){
                        if($row->images->first()){
                            $location = Storage::disk('uploads')->url($row->images->first()->location);
                            $img = "<img src='$location'  class='small-img img img-fluid'/>";
                        }else{
                            $img = "<img src='//via.placeholder.com/300'  class='small-img img img-fluid'/>";
                        }
                            return $img;

                    })
                    ->addColumn('is_offer', function($row){
                        $is_offer = $row->is_offer;
                        if($is_offer == 0){
                            $is_offer='No';
                        }else{
                            $is_offer='Yes';
                        }
                        return $is_offer;
                    })
                    ->addColumn('action', function($row){
                        $edit = route('category.edit',['category'=>$row->id]);
                        $action = route('category.destroy',['category'=>$row->id]);
                        $method = method_field('delete').csrf_field();

                           $btn = "<a href='$edit' class='edit btn btn-primary btn-sm'>Edit</a>
                           <form action='$action' method='post'>
                                $method
                                <button type='submit' name='submit' class='btn btn-danger'><small>Delete</small></button>
                            </form>
                           ";

                            return $btn;
                    })
                    ->rawColumns(['status','image' ,'is_offer','action'])
                    ->make(true);
        }

        return view('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.create');
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
        $data = $this->validate($request, [
            'name'=>'string|required',
            'slug'=>'string|required',
            'status'=>'boolean|required',
            'is_offer'=>'boolean|required',

        ]);
        $category = Category::create([
            'name'=>$data['name'],
            'slug'=>$data['slug'],
            'status'=>$data['status'],
            'is_offer'=>$data['is_offer'],

        ]);
        $images= Category_Image::where('category_id', 0)->where('user_id', Auth::user()->id)->get();
        foreach ($images as $image) {
            $image->category_id = $category->id;
            $image->save();
        }


        return view('backend.category.index')->with('success','Category Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findorfail($id);
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::findorfail($id);
        $data = $this->validate($request, [
            'name'=>'string|required',
            'slug'=>'string|required',
            'status'=>'boolean|required',
            'is_offer'=>'boolean|required'
        ]);
        $category->update([
            'name'=>$data['name'],
            'slug'=>$data['slug'],
            'status'=>$data['status'],
            'is_offer'=>$data['is_offer']
        ]);
        $images= Category_Image::where('category_id', 0)->where('user_id', Auth::user()->id)->get();
        foreach ($images as $image) {
            $image->category_id = $category->id;
            $image->save();
        }

        return redirect()->route('category.index')->with('success','Category Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findorFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success','Category Successfully deleted');
    }
}
