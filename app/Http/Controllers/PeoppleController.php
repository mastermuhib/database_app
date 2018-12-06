<?php

namespace App\Http\Controllers;
use App\Peopple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PeoppleController extends Controller
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
            <?php $ds = Auth::user()->desas_id ;?>
            <?php $i = Auth::user()->kelompoks_id ;?>
            <?php $u = Auth::user()->rules_id ;?>
    <?php
        if ($u == 1){
                    $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','peopples.posisi as posisi')
                        ->paginate(7);
        }elseif ($u == 2){
                    $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','peopples.posisi as posisi')
                        ->where('daerahs.id','=', $d)
                        ->paginate(7);
        }elseif ($u == 3){
                    $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','peopples.posisi as posisi')
                        ->where('desas.id','=', $ds)
                        ->paginate(7);
        } elseif ($u == 4) {
                    $peopples = DB::table('peopples')
                    ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                    ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                    ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                    ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                    ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','peopples.posisi as posisi')
                    ->where('kelompoks.id','=', $i)
                    ->paginate(7);
        }

        return view('peopple.index', ['peopple' => $peopples]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peopple.create');
    }

    public function getkelompok($id)
    { 
        $kelompok = DB::table('kelompoks')
         ->select('name','id')
         ->WHERE('desas_id',$id)->get();

        return json_encode($kelompok);
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
        $peopple= new \App\Peopple;
        $peopple->name=$request->get('name');
        $peopple->daerahs_id=$request->get('daerahs_id');
        $peopple->desas_id=$request->get('desas_id');
        $peopple->kelompoks_id=$request->get('kelompoks_id');
        $peopple->addres=$request->get('addres');
        $peopple->phone=$request->get('phone');
        $peopple->birthday=$request->get('birthday');
        $peopple->status=$request->get('status');
        $peopple->save();
   
        return redirect()->route('peopple.index')
                        ->with('success','peopple created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peopple  $peopple
     * @return \Illuminate\Http\Response
     */
    public function storeguru(Request $request)
    {
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
        $user->save();   
        return redirect()->route('users.index')
                        ->with('success','users created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peopple = \App\Peopple::find($id);
        return view('peopple.show',compact('peopple','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peopple  $peopple
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peopple = \App\Peopple::find($id);
        return view('peopple.edit',compact('peopple','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peopple  $peopple
     * @return \Illuminate\Http\Response
     */
    public function addguru($id)
    {
        $peopple = \App\Peopple::find($id);
        return view('peopple.addguru',compact('peopple','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peopple  $peopple
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $peopple= \App\Peopple::find($id);
        $peopple->update($request->all());
  
        return redirect()->route('peopple.index')
                        ->with('success','peopple updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peopple  $peopple
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peopple = \App\Peopple::find($id);
        $peopple->delete();
  
        return redirect()->route('peopple.index')
                        ->with('success','peopplet deleted successfully');
    }
}
