@extends('layouts.apps') 
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
<?php $i = Auth::user()->daerahs_id ; ?>
@if ($st >=  1 && $st <=  8 )
<script type="text/javascript" async="" src="{{asset('assets/js/search.js')}}"></script>   
<script type="text/javascript" async="" src="{{asset('assets/DataTables/datatables.js')}}"></script>   
<script type="text/javascript" async="" src="{{asset('assets/DataTables/datatables.css')}}"></script>   
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="search" style="float: right;" />
    <a class="btn btn-danger" href="{{ route('event.index') }}"> Back</a>
    <form method="POST" action="{{ route('absensi.store') }}">
         @csrf
    <table class="order-table table table-bordered">
        <tr>
            <th>NOMOR</th>
            <th>Name peopple</th>
            <th>Alamat</th>
            <th>status</th>
            <th>Absensi</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($peopples as $product)
        <?php $posisi = $product->posisi ;
          if ($posisi == 1) {
              $posisi = "guru";
          } elseif ($posisi == 2) {
              $posisi = "murid";
          } else {
              $posisi = "Netral";
          }
        ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->alamat }}</td>
            <td>{{ $posisi }}</td>
             <?php if ( $product->hadir != NULL ) { ?>
             <td><input type="checkbox" id="uncek" name="peopple_id[]" value="{{ $product->id }}" checked="true"><input type="hidden" name="event_id" value="{{ Request::segment(2) }}"></td>
        <?php } else { ?>
            <td><input type="checkbox" name="peopple_id[]" value="{{ $product->id }}"><input type="hidden" name="event_id" value="{{ Request::segment(2) }}"></td>
        <?php } ?>
        </tr>
        <?php $no++; ?>
        @endforeach
    </table>
<div style="padding-top: 10px;">
    <div class="pull-right">
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan Absensi</button> ||
        <button type="submit" class="btn btn-danger" name="rekap" value ="rekap">Rekap dan Tutup</button>
    </div>
</div>
</form>
@else
<div class="card" style="margin-top: 100px;">
            <div class="card-header">I'M  Sorry</div>

            <div class="card-body">
                <div class="alert alert-succes" role="alert">
                   <h1> ACCES DENIED </h1>
                </div>
                    You are not super admin!!
                <h3>Hanya Super Admin Yang dapat mengakses halaman ini</h3>
            </div>
</div>
@endif
@else
<div class="card"  style="margin-top: 100px;">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                    <div class="alert alert-succes" role="alert">
                       <h1> ACCES DENIED </h1>
                    </div>
                You are not access in here!!
                <h3>Please  <a  href="{{ route('login') }}">Login </a> or <a href="{{ route('login') }}">Register</a></h3>
            </div>
</div>
@endauth
@endif 
@endsection
<script type="text/javascript" async="" src="{{asset('assets/js/jquery3.js')}}"></script>   
<script>
$(document).ready(function(){
    
    $("#uncek").click(function () {
        
    console.log("berhasil")     
    }); 
        
  });    
</script>