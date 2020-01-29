<?php

namespace App\Http\Controllers;

use App\Add_on;
use App\Addons_Food;
use App\Food;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Facades\DataTables;

class AddonsFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $addons= Add_on::latest()->get();
        $foods = Food::latest()->get();
        if($request->ajax()){
            $data = Addons_Food::with('food','add_on')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('foods', function($row){
                    if($row->food == null) return '-';
                    $food = $row->food->name;
                    return $food;
                })
                ->addColumn('add_on', function($row){
                    if($row->add_on == null) return '-';
                    $add_on = $row->add_on->name;
                    return $add_on;
                })
                ->addColumn('action', function($row){

                    $food = $row->food_id;
                    $add_on = $row->add_on_id;

                    $action = route('addonassign.destroy',['addonassign'=>$row->id]);
                    $method = method_field('delete').csrf_field();
                    $id = $row->id;
                       $btn = "

                       <button type='button'  data-toggle='modal' data-food='$food' data-addon='$add_on' data-target='#editassign' data-id ='$id' class='btn btn-success'>edit</button>

                       <form action='$action' method='post'>
                            $method
                            <button type='submit' name='submit' class='btn btn-danger'><small>Delete</small></button>
                        </form>

                       ";

                        return $btn;
                })
                ->rawColumns(['action', 'foods', 'add_on'])
                ->make(true);

        }
        return view('backend.addonsassign.index', compact('addons','foods'));
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
        $data = $this->validate($request, [
            'food'=>'required|integer',
            'addon'=>'required|integer'
        ]);
        $addon_assign = Addons_Food::create([
            'food_id'=>$data['food'],
            'add_on_id'=>$data['addon']
        ]);
        $addon_assign->save();
        return redirect()->route('addonassign.index')->with('success', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Addons_Food  $addons_Food
     * @return \Illuminate\Http\Response
     */
    public function show(Addons_Food $addons_Food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Addons_Food  $addons_Food
     * @return \Illuminate\Http\Response
     */
    public function edit(Addons_Food $addons_Food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Addons_Food  $addons_Food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $addonassign = Addons_Food::findorfail($id);
        $data = $this->validate($request, [
            'food'=>'required|integer',
            'addon'=>'required|integer'
        ]);
        $addonassign->update([
            'food_id'=>$data['food'],
            'add_on_id'=>$data['addon']
        ]);
        $addonassign->save();
        return redirect()->route('addonassign.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Addons_Food  $addons_Food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $addon_assign = Addons_Food::findorfail($id);
        $addon_assign->delete();
        return redirect()->route('addonassign.index')->with('success', 'Successfully Deleted');

    }
}
