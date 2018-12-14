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
    <form method="POST" action="">
         @csrf
    <table class="order-table table table-bordered">
        <tr>
            <th>NOMOR</th>
            <th>Name peopple</th>
            <th>Alamat</th>
            <th>Keterangan</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($peopples as $product)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $product->p_name }}</td>
            <td>{{ $product->alamat }}</td>
             <?php if ( $product->abs == 1 ) { ?>
            <td style="background-color: #7FFFD4;"> Hadir </td>
        <?php } else { ?>
            <td style="background-color: #FF1493;"> Tidak Hadir </td>
        <?php } ?>
        </tr>
        <?php $no++; ?>
        @endforeach
    </table>
<div style="padding-top: 10px;">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <strong>Jumlah Orang   :</strong><span style="margin-left: 20px;">{{$count}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: -10px;">
            <div class="form-group">
                <strong>Hadir   :</strong><span style="margin-left: 20px;">{{$hadir}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: -10px;">
            <div class="form-group">
                <strong>tidak Hadir   :</strong><span style="margin-left: 20px;"> {{$absen}} </span>
            </div>
        </div>
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