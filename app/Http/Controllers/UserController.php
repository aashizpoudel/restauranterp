<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
            $data = User::latest()->with('role')->where('role_id', '!=', '0')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $edit = route('user.edit',['user'=>$row->id]);
                        $delete = route('user.destroy',['user'=>$row->id]);

                           $btn = "<a href='$edit' class='edit btn btn-primary btn-sm'>Edit</a><a href='$delete' class='delete btn btn-danger btn-sm'>Delete</a>";

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.users.create');
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
            'name'=>'required|string',
            'email'=>'required|email',
            'role'=>'required|integer',
            'password'=>'required|string|min:6|max:15|confirmed'
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'role_id'=>$data['role'],
            'password'=>bcrypt($data['password']),
            'added_by'=>Auth::user()->id,

        ]);
        $user->save();
        return redirect()->route('user.index')->with('success', 'User Succesfully Created');
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
        //
        $user = User::findorFail($id);
        return view('backend.users.edit', compact('user'));

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
        //
        $user = User::findorFail($id);
        $data = $this->validate($request, [
            'name'=>'required|string',
            'email'=>'required|email',
            'role'=>'required|integer'
        ]);
        $user->update([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'role_id'=>$data['role'],


        ]);
        $user->save();
        return view('backend.users.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findorFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Successfully Deleted');
    }
}
