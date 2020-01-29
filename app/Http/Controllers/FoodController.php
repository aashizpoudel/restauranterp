<?php

namespace App\Http\Controllers;

use App\Add_on;
use App\Category;
use App\Food;
use App\Food_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class FoodController extends Controller
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
            $data = Food::latest()->orderBy('id','desc')->get();
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
                    ->addColumn('description', function($row){
                        $description = substr($row->description,0,50). '...';
                        return $description;
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
                    ->addColumn('is_special', function($row){
                        $is_special = $row->is_special;
                        if($is_special == 0){
                            $is_special='No';
                        }else{
                            $is_special='Yes';
                        }
                        return $is_special;
                    })
                    ->addColumn('action', function($row){
                        $edit = route('food.edit',['food'=>$row->id]);
                        $action = route('food.destroy',['food'=>$row->id]);
                        $method = method_field('delete').csrf_field();

                           $btn = "<a href='$edit' class='edit btn btn-primary btn-sm'>Edit</a>
                           <form action='$action' method='post'>
                                $method
                                <button type='submit' name='submit' class='btn btn-danger'><small>Delete</small></button>
                            </form>
                           ";

                            return $btn;
                    })
                    ->rawColumns(['description','status','image' ,'is_offer','is_special' ,'action'])
                    ->make(true);
        }
        return view('backend.food.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::latest()->get();

        return view('backend.food.create', compact('category', 'addons'));
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
            'category_id'=>'integer|required',
            'name'=>'string|required',
            'slug'=>'string|required',
            'components'=>'string|required',
            'notes'=>'string|required',
            'description'=>'string|required',
            'price'=>'string|required',
            'vat'=>'string|required',
            'is_offer'=>'boolean|required',
            'is_special'=>'boolean|required',
            'status'=>'boolean|required'
        ]);
        $food = Food::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'components' => $data['components'],
            'notes' => $data['notes'],
            'description' => $data['description'],
            'price' => $data['price'],
            'vat' => $data['vat'],
            'is_offer' => $data['is_offer'],
            'is_special' => $data['is_special'],
            'status' => $data['status']
        ]);

        $images= Food_Image::where('food_id', 0)->where('user_id', Auth::user()->id)->get();
        foreach ($images as $image) {
            $image->food_id = $food->id;
            $image->save();
        }
        return redirect()->route('food.index')->with('success', 'Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::latest()->get();
        $food = Food::findorfail($id);
        return view('backend.food.edit', compact('category','food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $food = Food::findorFail($id);
        $data = $this->validate($request, [
            'category_id'=>'integer|required',
            'name'=>'string|required',
            'slug'=>'string|required',
            'components'=>'string|required',
            'notes'=>'string|required',
            'description'=>'string|required',
            'vat'=>'string|required',
            'is_offer'=>'boolean|required',
            'is_special'=>'boolean|required',
            'status'=>'boolean|required'
        ]);
        $food->update([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'components' => $data['components'],
            'notes' => $data['notes'],
            'description' => $data['description'],
            'vat' => $data['vat'],
            'is_offer' => $data['is_offer'],
            'is_special' => $data['is_special'],
            'status' => $data['status']
        ]);

        $images= Food_Image::where('food_id', 0)->where('user_id', Auth::user()->id)->get();
        foreach ($images as $image) {
            $image->food_id = $food->id;
            $image->save();
        }
        return redirect()->route('food.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $food = Category::findorFail($id);
        $food->delete();

        return redirect()->route('food.index')->with('success', 'Successfully deleted');
    }
}
