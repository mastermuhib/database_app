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
        }
        return redirect()->route('event.index')
                        ->with('success','Absensi successfully.');
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

     if ($u == 1) {
        $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','absensi.peopple_id as peopple_abs','absensi.event_id as event','absensi.status as status')->distinct()
                        ->where('absensi.event_id','=', $id)
                        ->paginate(7);
        $count = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->where('kelas.id','=', $kelas)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $hadir = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                            ->where('absensi.event_id','=', $id)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $absen = $count - $hadir;
            return view('absensi.show')->with(['peopples' => $peopples])->with(['count' => $count])->with(['hadir' => $hadir])->with(['absen' => $absen]);
     } elseif ($u == 2) {
        $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','absensi.peopple_id as peopple_abs','absensi.event_id as event','absensi.status as status')->distinct()
                        ->where('daerahs.id','=', $daerah)
                        ->paginate(7);
        $count = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->where('kelas.id','=', $kelas)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $hadir = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                            ->where('absensi.event_id','=', $id)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $absen = $count - $hadir;
            return view('absensi.show')->with(['peopples' => $peopples])->with(['count' => $count])->with(['hadir' => $hadir])->with(['absen' => $absen]);
     } elseif ($u == 3) {
        $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','absensi.peopple_id as peopple_abs','absensi.event_id as event','absensi.status as status')->distinct()
                        ->where('desas.id','=', $desa)
                        ->get();
        $count = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                             ->where('desas.id','=', $desa)
                            ->count();
        $hadir = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                            ->where('absensi.event_id','=', $id)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $absen = $count - $hadir;
            return view('absensi.show')->with(['peopples' => $peopples])->with(['count' => $count])->with(['hadir' => $hadir])->with(['absen' => $absen]);
     } elseif ($u == 4) {
        $peopples = DB::table('peopples')
                        ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                        ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                        ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                        ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                        ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                        ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','absensi.peopple_id as peopple_abs','absensi.event_id as event','absensi.status as status')->distinct()
                        ->where('kelompoks.id','=', $kelompok)
                        ->where('absensi.event_id','=', $id)
                        ->paginate(7);
        $count = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->where('kelompoks.id','=', $kelompok)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $hadir = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                            ->where('absensi.event_id','=', $id)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $absen = $count - $hadir;
            return view('absensi.show')->with(['peopples' => $peopples])->with(['count' => $count])->with(['hadir' => $hadir])->with(['absen' => $absen]);

     } else {
         $peopples = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                            ->select('peopples.id as id','peopples.addres as alamat','daerahs.name as name1','kelompoks.name as name3','peopples.name as name4', 'desas.name as name2','kelas.name as name5','absensi.peopple_id as peopple_abs','absensi.event_id as event','absensi.status as status')->distinct('absensi.peopple_id')
                            ->where('kelas.id','=', $kelas)
                            ->where('absensi.event_id','=', $id)
                            ->where('peopples.posisi','=', 2)
                            ->paginate(7);
        $count = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->where('kelas.id','=', $kelas)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $hadir = DB::table('peopples')
                            ->leftJoin('daerahs', 'daerahs.id', '=', 'peopples.daerahs_id')
                            ->leftJoin('desas', 'desas.id', '=', 'peopples.desas_id')
                            ->leftJoin('kelompoks', 'kelompoks.id', '=', 'peopples.kelompoks_id')
                            ->leftJoin('kelas', 'kelas.id', '=', 'peopples.kelas_id')
                            ->leftJoin('absensi', 'absensi.peopple_id', '=', 'peopples.id')
                            ->where('absensi.event_id','=', $id)
                            ->where('peopples.posisi','=', 2)
                            ->count();
        $absen = $count - $hadir;
            return view('absensi.show')->with(['peopples' => $peopples])->with(['count' => $count])->with(['hadir' => $hadir])->with(['absen' => $absen]);
    }
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
