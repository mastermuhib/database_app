<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\daerah;
use Auth;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $daerah = DB::table('daerah')->get();
        ?>
        @if (Route::has('login'))
        @auth
    <?php $i = Auth::user()->daerahs_id ;?>
    <?php $u = Auth::user()->rules_id ;?>
        @endauth
        @endif
    <?php
        if ($u == 1){
                        $daerah = DB::table('daerahs')
                        ->select('id','name')
                        ->paginate(5);
        } else {
                        $daerah = DB::table('daerahs')
                        ->select('id','name')
                        ->where('id','=', $i)
                        ->get();
        }
        return view('daerah.index', ['daerah' => $daerah]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                return view('daerah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        Daerah::create($request->all());
   
        return redirect()->route('daerah.index')
                        ->with('success','daerah created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daerah = \App\daerah::find($id);
        return view('daerah.show',compact('daerah','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daerah = \App\daerah::find($id);
        return view('daerah.edit',compact('daerah','id'));
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
        $daerah= \App\daerah::find($id);
        $daerah->update($request->all());
  
        return redirect()->route('daerah.index')
                        ->with('success','daerah updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daerah = \App\daerah::find($id);
        $daerah->delete();
  
        return redirect()->route('daerah.index')
                        ->with('success','daeraht deleted successfully');
    }
}
