<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\kelompok;
use Illuminate\Http\Request;
use Auth;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    ?>
    <?php $d = Auth::user()->daerahs_id ;?>
    <?php $i = Auth::user()->desas_id ;?>
    <?php $u = Auth::user()->rules_id ;?>
    <?php
        if ($u == 1){
                      $kelompoks = DB::table('kelompoks')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'kelompoks.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'kelompoks.desas_id')
                            ->select('kelompoks.id as id','daerahs.name as name1','kelompoks.name as name3', 'desas.name as name2')
                            ->paginate(7);
        } elseif ($u == 2){
                      $kelompoks = DB::table('kelompoks')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'kelompoks.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'kelompoks.desas_id')
                            ->select('kelompoks.id as id','daerahs.name as name1','kelompoks.name as name3', 'desas.name as name2')
                            ->where('daerahs.id','=', $d)
                            ->paginate(7);
        } else {
                        $kelompoks = DB::table('kelompoks')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'kelompoks.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'kelompoks.desas_id')
                        ->select('kelompoks.id as id','daerahs.name as name1','kelompoks.name as name3', 'desas.name as name2')
                        ->where('desas.id','=', $i)
                        ->paginate(7);
        }

        return view('kelompok.index', ['kelompok' => $kelompoks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelompok.create');
    }

    public function getdesa($id)
    { 
        $desa = DB::table('desas')
         ->select('name','id')
         ->WHERE('daerahs_id',$id)->get();

        return json_encode($desa);
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
        $kelompok= new \App\kelompok;
        $kelompok->name=$request->get('name');
        $kelompok->desas_id=$request->get('desas_id');
        $kelompok->daerahs_id=$request->get('daerahs_id');
        $kelompok->save();
   
        return redirect()->route('kelompok.index')
                        ->with('success','kelompok created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelompok = \App\kelompok::find($id);
        return view('kelompok.show',compact('kelompok','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelompok = \App\kelompok::find($id);
        return view('kelompok.edit',compact('kelompok','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $kelompok= \App\kelompok::find($id);
        $kelompok->update($request->all());
  
        return redirect()->route('kelompok.index')
                        ->with('success','kelompok updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelompok = \App\kelompok::find($id);
        $kelompok->delete();
  
        return redirect()->route('kelompok.index')
                        ->with('success','kelompokt deleted successfully');
    }
}
