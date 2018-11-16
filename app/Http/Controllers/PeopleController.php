<?php

namespace App\Http\Controllers;

use App\people;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $peoples = DB::table('peoples')
            ->leftJoin('daerahs', 'daerahs.id', '=', 'peoples.kelompoks_id')
            ->leftJoin('desas', 'desas.id', '=', 'peoples.kelompoks_id')
            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peoples.kelompoks_id')
            ->select('daerahs.id as id','daerahs.name as name1','kelompoks.name as name3','peoples.name as name4', 'desas.name as name2')
            ->get();

        return view('people.index', ['people' => $peoples]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');
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
        $people= new \App\people;
        $people->name=$request->get('name');
        $people->kelompoks_id=$request->get('kelompoks_id');
        $people->addres=$request->get('addres');
        $people->phone=$request->get('phone');
        $people->birthday=$request->get('birthday');
        $people->status=$request->get('status');
        $people->save();
   
        return redirect()->route('people.index')
                        ->with('success','people created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\people  $people
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $people = \App\people::find($id);
        return view('people.show',compact('people','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\people  $people
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $people = \App\people::find($id);
        return view('people.edit',compact('people','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\people  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $people= \App\people::find($id);
        $people->update($request->all());
  
        return redirect()->route('people.index')
                        ->with('success','people updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\people  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $people = \App\people::find($id);
        $people->delete();
  
        return redirect()->route('people.index')
                        ->with('success','peoplet deleted successfully');
    }
}
