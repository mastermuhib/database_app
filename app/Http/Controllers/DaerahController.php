<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\daerah;

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
        $daerah = daerah::latest()->paginate(5);
  
        return view('daerah.index',compact('daerah'));
        with('i', (request()->input('page', 1) - 1) * 5);
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
