<?php

namespace App\Http\Controllers;

use App\Add_on;
use App\Add_on_Image;
use Dotenv\Regex\Regex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AddOnController extends Controller
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
            $data = Add_on::latest()->orderBy('id','desc')->get();
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

                    ->addColumn('action', function($row){
                        $edit = route('addon.edit',['addon'=>$row->id]);
                        $action = route('addon.destroy',['addon'=>$row->id]);
                        $method = method_field('delete').csrf_field();

                           $btn = "<a href='$edit' class='edit btn btn-primary btn-sm'>Edit</a>
                           <form action='$action' method='post'>
                                $method
                                <button type='submit' name='submit' class='btn btn-danger'><small>Delete</small></button>
                            </form>
                           ";

                            return $btn;
                    })
                    ->rawColumns(['status','image','action'])
                    ->make(true);
        }

        return view('backend.add__on.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.add__on.create');
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
            'price'=>'string|required',
            'status'=>'boolean|required'
        ]);
        $addon = Add_on::create([
            'name'=> $data['name'],
            'slug'=> $data['slug'],
            'price'=> $data['price'],
            'status'=> $data['status']
        ]);
        $images= Add_on_Image::where('addon_id', 0)->where('user_id', Auth::user()->id)->get();
        foreach ($images as $image) {
            $image->addon_id = $addon->id;
            $image->save();
        }
        return redirect()->route('addon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Add_on  $add_on
     * @return \Illuminate\Http\Response
     */
    public function show(Add_on $add_on)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Add_on  $add_on
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $addon = Add_on::findorfail($id);
        return view('backend.add__on.edit', compact('addon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Add_on  $add_on
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $addon = Add_on::findorFail($id);
        $data = $this->validate($request, [
            'name'=>'string|required',
            'slug'=>'string|required',
            'price'=>'string|required',
            'status'=>'boolean|required'
        ]);
        $addon->update([
            'name'=> $data['name'],
            'slug'=> $data['slug'],
            'price'=> $data['price'],
            'status'=> $data['status']
        ]);
        $images= Add_on_Image::where('addon_id', 0)->where('user_id', Auth::user()->id)->get();
        foreach ($images as $image) {
            $image->addon_id = $addon->id;
            $image->save();
        }
        return redirect()->route('addon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Add_on  $add_on
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $addon = Add_on::findorfail($id);
        $addon->delete();

        return redirect()->route('addon.index');

    }
}
