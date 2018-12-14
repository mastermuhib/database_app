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
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'event.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'event.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'event.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'event.kelas_id')
                        ->leftJoin('absensi', 'event.id', '=', 'absensi.event_id')
                        ->select('event.id as id', 'event.name as name','absensi.event_id as event','absensi.status as status','event.created_at as date','desas.name as desa','daerahs.name as daerah','kelompoks.name as kelompok','kelas.name as kelas','desas.id as iddesa','daerahs.id as iddaerah','kelompoks.id as idkelompok','kelas.id as idkelas')->distinct()
                        ->orderBy('daerah', 'ASC')
                        ->get();
            } elseif ($u == 2){
                         $event = DB::table('event')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'event.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'event.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'event.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'event.kelas_id')
                        ->leftJoin('absensi', 'event.id', '=', 'absensi.event_id')
                        ->select('event.id as id', 'event.name as name','absensi.event_id as event','absensi.status as status','event.created_at as date','desas.name as desa','daerahs.name as daerah','kelompoks.name as kelompok','kelas.name as kelas','desas.id as iddesa','daerahs.id as iddaerah','kelompoks.id as idkelompok','kelas.id as idkelas')->distinct()
                        ->orderBy('desa', 'ASC')
                        ->where('event.daerahs_id', '=', $daerah)
                        ->get();
            } elseif ($u == 3){
                         $event = DB::table('event')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'event.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'event.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'event.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'event.kelas_id')
                        ->leftJoin('absensi', 'event.id', '=', 'absensi.event_id')
                        ->select('event.id as id', 'event.name as name','absensi.event_id as event','absensi.status as status','event.created_at as date','desas.name as desa','daerahs.name as daerah','kelompoks.name as kelompok','kelas.name as kelas','desas.id as iddesa','daerahs.id as iddaerah','kelompoks.id as idkelompok','kelas.id as idkelas')->distinct()
                        ->orderBy('kelompok', 'ASC')
                        ->where('event.desas_id', '=', $desa)
                        ->paginate(14);
            } elseif ($u == 4){
                         $event = DB::table('event')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'event.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'event.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'event.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'event.kelas_id')
                        ->leftJoin('absensi', 'event.id', '=', 'absensi.event_id')
                        ->select('event.id as id', 'event.name as name','absensi.event_id as event','absensi.status as status','event.created_at as date','desas.name as desa','daerahs.name as daerah','kelompoks.name as kelompok','kelas.name as kelas','desas.id as iddesa','daerahs.id as iddaerah','kelompoks.id as idkelompok','kelas.id as idkelas')->distinct()
                        ->orderBy('name', 'ASC')
                        ->where('event.kelompoks_id', '=', $kelompok)
                        ->paginate(7);
            } elseif ($u == 5){
                         $event = DB::table('event')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'event.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'event.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'event.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'event.kelas_id')
                        ->leftJoin('absensi', 'event.id', '=', 'absensi.event_id')
                        ->select('event.id as id', 'event.name as name','absensi.event_id as event','absensi.status as status','event.created_at as date','desas.name as desa','daerahs.name as daerah','kelompoks.name as kelompok','kelas.name as kelas','desas.id as iddesa','daerahs.id as iddaerah','kelompoks.id as idkelompok','kelas.id as idkelas')->distinct()
                        ->where('event.kelas_id', '=', $kelas)
                        ->get();
            } else {
                        $event = DB::table('event')
                        ->leftJoin('absensi', 'event.id', '=', 'absensi.event_id')
                        ->select('event.id as id', 'event.name as name','event.created_at as date','absensi.status as status')
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
     $daerah = Auth::user()->daerahs_id ;
     $desa = Auth::user()->desas_id ;
     $kelompok = Auth::user()->kelompoks_id ;
     $kelas = Auth::user()->kelas_id ;

     if ($u == 1) {
        $peopples = DB::table('absensi')
                        ->leftJoin('peopples', 'absensi.peopple_id', '=', 'peopples.id')
                        ->leftJoin('event', 'absensi.event_id', '=', 'event.id')
                        ->select('absensi.peopple_id as id','peopples.addres as alamat','peopples.name as name','event.name as event_name','absensi.kehadiran as hadir','peopples.posisi as posisi')->distinct()
                        ->where('absensi.event_id','=', $id)
                        ->get();
        return view('event.show', ['peopples' => $peopples]);
     } elseif ($u == 2) {
        $peopples = DB::table('absensi')
                        ->leftJoin('peopples', 'absensi.peopple_id', '=', 'peopples.id')
                        ->leftJoin('event', 'absensi.event_id', '=', 'event.id')
                        ->select('absensi.peopple_id as id','peopples.addres as alamat','peopples.name as name','event.name as event_name','absensi.kehadiran as hadir','peopples.posisi as posisi')->distinct()
                        ->where('absensi.event_id','=', $id)
                        ->get();
        return view('event.show', ['peopples' => $peopples]);
     } elseif ($u == 3) {
        $peopples = DB::table('absensi')
                        ->leftJoin('peopples', 'absensi.peopple_id', '=', 'peopples.id')
                        ->leftJoin('event', 'absensi.event_id', '=', 'event.id')
                        ->select('absensi.peopple_id as id','peopples.addres as alamat','peopples.name as name','event.name as event_name','absensi.kehadiran as hadir','peopples.posisi as posisi')->distinct()
                        ->where('absensi.event_id','=', $id)
                        ->get();
        return view('event.show', ['peopples' => $peopples]);
        
     } elseif ($u == 4) {
        $peopples = DB::table('absensi')
                        ->leftJoin('peopples', 'absensi.peopple_id', '=', 'peopples.id')
                        ->leftJoin('event', 'absensi.event_id', '=', 'event.id')
                        ->select('absensi.peopple_id as id','peopples.addres as alamat','peopples.name as name','event.name as event_name','absensi.kehadiran as hadir','peopples.posisi as posisi')->distinct()
                        ->where('absensi.event_id','=', $id)
                        ->get();
        return view('event.show', ['peopples' => $peopples]);

     } else {
         $peopples = DB::table('absensi')
                        ->leftJoin('peopples', 'absensi.peopple_id', '=', 'peopples.id')
                        ->leftJoin('event', 'absensi.event_id', '=', 'event.id')
                        ->select('absensi.peopple_id as id','peopples.addres as alamat','peopples.name as name','event.name as event_name','absensi.kehadiran as hadir','peopples.posisi as posisi')->distinct()
                        ->where('absensi.event_id','=', $id)
                        ->get();
        return view('event.show', ['peopples' => $peopples]);
    }
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
                        ->with('success','event deleted successfully');
    }
}
