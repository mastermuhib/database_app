<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\event;
use Illuminate\Http\Request;
use Auth;

class EventController extends Controller
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
                <?php $u = Auth::user()->rules_id ;?>
                <?php $daerah = Auth::user()->daerahs_id ;?>
                <?php $desa = Auth::user()->desas_id ;?>
                <?php $kelompok = Auth::user()->kelompoks_id ;?>
                <?php $kelas = Auth::user()->kelas_id ;?>
        <?php
            if ($u == 1){
                        $event = DB::table('event')
                        ->select('event.id as id', 'event.name as name','event.created_at as date')
                        ->paginate(7);
            } elseif ($u == 2){
                        $event = DB::table('event')
                        ->select('event.id as id', 'event.name as name','event.created_at as date')
                        ->where('event.daerahs_id', '=', $daerah)
                        ->paginate(7);
            } elseif ($u == 3){
                        $event = DB::table('event')
                        ->select('event.id as id', 'event.name as name','event.created_at as date')
                        ->where('event.desas_id', '=', $desa)
                        ->paginate(7);
            } elseif ($u == 4){
                        $event = DB::table('event')
                        ->select('event.id as id', 'event.name as name','event.created_at as date')
                        ->where('event.kelompoks_id', '=', $kelompok)
                        ->paginate(7);
            } elseif ($u == 5){
                        $event = DB::table('event')
                        ->select('event.id as id', 'event.name as name','event.created_at as date')
                        ->where('event.kelas_id', '=', $kelas)
                        ->paginate(7);
            } else {
                        $event = DB::table('event')
                        ->select('event.id as id', 'event.name as name','event.created_at as date')
                        ->paginate(7);
            }

            return view('event.index', ['event' => $event]);?>
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
        return view('event.create');
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
        $event= new \App\event;
        $event->name=$request->get('name');
        $event->user_id=$request->get('user_id');
        $event->daerahs_id=$request->get('daerahs_id');
        $event->desas_id=$request->get('desas_id');
        $event->kelompoks_id=$request->get('kelompoks_id');
        $event->kelas_id=$request->get('kelas_id');
        $event->save();
   
        return redirect()->route('event.index')
                        ->with('success','event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                 if (Auth::check()) {
                 $u = Auth::user()->rules_id ;
                 $kelas = Auth::user()->kelas_id ;
       $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5')
                        ->where('kelas.id','=', $kelas)
                        ->paginate(7);
        return view('event.show', ['peopples' => $peopples]);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = \App\event::find($id);
        return view('event.edit',compact('event','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $event= \App\event::find($id);
        $event->update($request->all());
  
        return redirect()->route('event.index')
                        ->with('success','event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = \App\event::find($id);
        $event->delete();
  
        return redirect()->route('event.index')
                        ->with('success','eventt deleted successfully');
    }
}
