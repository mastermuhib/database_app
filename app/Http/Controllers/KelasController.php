<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\kelas;
use Illuminate\Http\Request;
use Auth;

class KelasController extends Controller
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
            <?php $i = Auth::user()->kelompoks_id ;?>
            <?php $u = Auth::user()->rules_id ;?>
    <?php
        if ($u == 4){
                    $kelas = DB::table('kelas')
                    ->leftJoin('kelompoks', 'kelompoks.id', '=', 'kelas.kelompoks_id')
                    ->select('kelas.id as id', 'kelas.name as name')
                    ->where('kelompoks.id','=', $i)
                    ->paginate(7);
        } else {
                    $kelas = DB::table('kelas')
                    ->leftJoin('kelompoks', 'kelompoks.id', '=', 'kelas.kelompoks_id')
                    ->select('kelas.id as id', 'kelas.name as name')
                    ->where('kelompoks.id','=', $i)
                    ->paginate(7);
        }

        return view('kelas.index', ['kelas' => $kelas]);?>
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
       return view('kelas.create');
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
        $kelas= new \App\kelas;
        $kelas->name=$request->get('name');
        $kelas->kelompoks_id=$request->get('kelompoks_id');
        $kelas->daerahs_id=$request->get('daerahs_id');
        $kelas->desas_id=$request->get('desas_id');
        $kelas->save();
   
        return redirect()->route('kelas.index')
                        ->with('success','kelas created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5')
                        ->where('kelas.id','=', $id)
                        ->paginate(7);
        return view('kelas.show', ['peopples' => $peopples]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = \App\kelas::find($id);
        return view('kelas.edit',compact('kelas','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $kelas= \App\kelas::find($id);
        $kelas->update($request->all());
  
        return redirect()->route('kelas.index')
                        ->with('success','kelas updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = \App\kelas::find($id);
        $kelas->delete();
  
        return redirect()->route('kelas.index')
                        ->with('success','kelast deleted successfully');
    }
}
