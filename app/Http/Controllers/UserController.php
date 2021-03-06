<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ?>
        <?php if (Auth::check()) { ?>
            <?php $d = Auth::user()->daerahs_id ;?>
            <?php $ds = Auth::user()->desas_id ;?>
            <?php $i = Auth::user()->kelompoks_id ;?>
            <?php $u = Auth::user()->rules_id ;?>
        <?php 
        $user = DB::table('users')
            ->select('id','name', 'email','rules_id')
            ->paginate(7);

        return view('users.index', ['user' => $user]);
        ?>
        <?php } else {
        return redirect('home');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    if (Auth::check()) {
    $u = Auth::user()->rules_id ;
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user= new \App\User;
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->rules_id=$request->get('rules_id');
        $user->password=Hash::make($request->get('password'));
        $user->daerahs_id=$request->get('daerahs_id');
        $user->desas_id=$request->get('desas_id');
        $user->kelompoks_id=$request->get('kelompoks_id');
        $user->kelas_id=$request->get('kelas_id');
        $user->people_id=$request->get('people_id');
        $user->save(); 
        if ($u == 1) {
        return redirect()->route('users.index')
                        ->with('success','users created successfully.');
        }else {
        return redirect()->route('peopple.index')
                        ->with('success','Add Guru successfully.');
        }
    } else {
        return redirect('home');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::find($id);
        return view('users.show',compact('user','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);
        return view('users.edit',compact('user','id'));
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
        $request->validate([
            'name' => 'required',
        ]);
        $user= \App\User::find($id);
        $user->update($request->all());
  
        return redirect()->route('users.index')
                        ->with('success','user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::find($id);
        $user->delete();
  
        return redirect()->route('users.index')
                        ->with('success','usert deleted successfully');
    }
}
