<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $desas = DB::table('desas')
            ->leftJoin('daerahs', 'daerahs.id', '=', 'desas.daerahs_id')
            ->select('desas.id as id','daerahs.name as name1', 'desas.name as name2')
            ->get();

        return view('desa.index', ['desa' => $desas]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('desa.create');
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
        $desa= new \App\desa;
        $desa->name=$request->get('name');
        $desa->daerahs_id=$request->get('daerahs_id');
        $desa->save();
   
        return redirect()->route('desa.index')
                        ->with('success','desa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desa = \App\desa::find($id);
        return view('desa.show',compact('desa','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $desa = \App\desa::find($id);
        return view('desa.edit',compact('desa','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $desa= \App\desa::find($id);
        $desa->update($request->all());
  
        return redirect()->route('desa.index')
                        ->with('success','desa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desa = \App\desa::find($id);
        $desa->delete();
  
        return redirect()->route('desa.index')
                        ->with('success','desat deleted successfully');
    }
//     public function data(){


//     $desaku = desa::all()->join('daerah', 'daerah.id', '=', 'desa.daerahs_id')->get();
//     return view::make(desa.data', compact('desaku'));

// }
}
