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
        DB::table('absensi')->where('absensi.event_id', $event_id)->delete();
        $idsiswa = $request->peopple_id;
        foreach ($idsiswa as $ids) {
            $student= new \App\absensi; // assume you use this model
            $student->peopple_id = $ids;
            $student->event_id=$request->get('event_id');
            $student->save();
        }
        }else if(Input::get('rekap')){
        $event_id=$request->get('event_id');
        $status = 1;
        DB::table('absensi')->where('absensi.event_id', $event_id)->delete();
        $idsiswa = $request->peopple_id;
        foreach ($idsiswa as $ids) {
            $student= new \App\absensi; // assume you use this model
            $student->peopple_id = $ids;
            $student->status = $status;
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
        //
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
