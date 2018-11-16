<?php
use Illuminate\Support\Facades\DB;
use App\desa;
$desas = DB::table('desas')
            ->where('desas.id','=','$_POST[daerah_id]')
            ->get();
?>
<div class="form-group">PILIH DESA
    <select name="desas_id" id="desa">
        @foreach($desas as $desa)
           <option value='{{ $desa->id }}'>{{ $desa->name }}</option>
        @endforeach
    </select>
            </div>