<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Auth;
use App\absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(Input::get('submit')) {
            $event_id=$request->get('event_id');
            $daerah_id=$request->get('daerah_id');
            $desa_id=$request->get('desa_id');
            $kelompok_id=$request->get('kelompok_id');
            $kelas_id=$request->get('kelas_id');
            
                if ($kelas_id != NULL ) {
                    $idsiswa = DB::table('peopples')->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                                         ->select('peopples.id as id','peopples.name')
                                         ->where('peopples.kelas_id','=', $kelas_id)->get();
                    foreach ($idsiswa as $ids) {
                        $student= new \App\absensi; 
                        $student->peopple_id =  $ids->id ;
                        $student->event_id=$request->get('event_id');
                        $student->save(); }
                } elseif ( $kelompok_id != NULL ) {
                    $idsiswa = DB::table('peopples')->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                                         ->select('peopples.id as id','peopples.name')
                                         ->where('peopples.kelompoks_id','=', $kelompok_id)->get();
                    foreach ($idsiswa as $ids) {
                        $student= new \App\absensi; 
                        $student->peopple_id =  $ids->id ;
                        $student->event_id=$request->get('event_id');
                        $student->save(); }
                } elseif ($desa_id != NULL ) {
                    $idsiswa = DB::table('peopples')->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                                         ->select('peopples.id as id','peopples.name')
                                         ->where('peopples.desas_id','=', $desa_id)->get();
                    foreach ($idsiswa as $ids) {
                        $student= new \App\absensi; 
                        $student->peopple_id =  $ids->id ;
                        $student->event_id=$request->get('event_id');
                        $student->save(); }
                } elseif ($daerah_id != NULL ) {
                    $idsiswa = DB::table('peopples')->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                                         ->select('peopples.id as id','peopples.name')
                                         ->where('peopples.daerahs_id','=', $daerah_id)->get();
                    foreach ($idsiswa as $ids) {
                        $student= new \App\absensi; 
                        $student->peopple_id =  $ids->id ;
                        $student->event_id=$request->get('event_id');
                        $student->save(); }
            } elseif ($daerah_id == NULL ) {
                    $idsiswa = DB::table('peopples')
                                         ->select('peopples.id as id','peopples.name')
                                         ->get();
                    foreach ($idsiswa as $ids) {
                        $student= new \App\absensi; 
                        $student->peopple_id =  $ids->id ;
                        $student->event_id=$request->get('event_id');
                        $student->save(); }
            }
            return redirect()->route('event.index')
                            ->with('success','Event sukses diaktifkan.');
        }else if(Input::get('save')){
                        $event_id=$request->get('event_id');
                                  $pages = DB::table('absensi')->where('absensi.event_id', $event_id)->update(['kehadiran' => NULL]);
                        $idsiswa = $request->peopple_id;
                        foreach ($idsiswa as $ids) {
                            $pages = DB::table('absensi')->where('absensi.peopple_id', $ids)->where('absensi.event_id', $event_id)
                                ->update(['kehadiran' => 1]);
                                }

                return redirect()->route('event.index')
                                        ->with('success','Absensi successfully.');
        }
        else if(Input::get('rekap')){
                        $event_id=$request->get('event_id');
                                  $pages = DB::table('absensi')->where('absensi.event_id', $event_id)->update(['kehadiran' => NULL]);
                        $idsiswa = $request->peopple_id;
                        foreach ($idsiswa as $ids) {
                            $pages = DB::table('absensi')->where('absensi.peopple_id', $ids)->where('absensi.event_id', $event_id)
                                ->update(['status' => 1,'kehadiran' => 1]);
                                }

                return redirect()->route('event.index')
                                        ->with('success','Absensi successfully.');
        }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\absensi  $absensi
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

        $peopples = DB::table('absensi')
                        ->leftJoin('event', 'event.id', '=', 'absensi.event_id')
                        ->leftJoin('peopples', 'absensi.peopple_id', '=', 'peopples.id')
                        ->select('absensi.peopple_id as id','peopples.addres as alamat','peopples.name as p_name','absensi.kehadiran as abs','absensi.event_id as event','absensi.status as status')->distinct()
                        ->where('event_id','=', $id)
                        ->paginate(7);
        $count = DB::table('absensi')
                            ->where('event_id','=', $id)
                            ->count();
        $hadir = DB::table('absensi')
                            ->where('event_id','=', $id)
                            ->where('absensi.kehadiran','=', 1)
                            ->count();
        $absen = $count - $hadir;
            return view('absensi.show')->with(['peopples' => $peopples])->with(['count' => $count])->with(['hadir' => $hadir])->with(['absen' => $absen]);
    }
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absensi = \App\absensi::find($id);
        $absensi->delete();
  
        return redirect()->route('event.index')
                        ->with('success','kelast deleted successfully');
    }
}
