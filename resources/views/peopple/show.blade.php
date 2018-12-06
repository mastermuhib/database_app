@extends('layouts.apps')
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
<?php $i = Auth::user()->daerahs_id ; ?>
<?php $ds = Auth::user()->desas_id ; ?>
<?php $kl = Auth::user()->kelompoks_id ; ?>
@if ($st >=  1 && $st <=  4 )
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show peopple</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('peopple.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <strong>Name   :</strong><span style="margin-left: 20px;">{{ $peopple->name }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: -10px;">
            <div class="form-group">
                <strong>Alamat   :</strong><span style="margin-left: 20px;">{{ $peopple->addres }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: -10px;">
            <div class="form-group">
                <strong>Nomor   :</strong><span style="margin-left: 20px;">{{ $peopple->phone }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: -10px;">
            <div class="form-group">
                <strong>Status   :</strong><span style="margin-left: 20px;">{{ $peopple->status }}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: -10px;">
            <div class="form-group">
                <strong>Birthday   :</strong><span style="margin-left: 20px;">{{ $peopple->birthday }}</span>
            </div>
        </div>
    </div>
@else
<div class="card" style="margin-top: 100px;">
                <div class="card-header">I'M  Sorry</div>

                <div class="card-body">
                        <div class="alert alert-succes" role="alert">
                           <h1> ACCES DENIED </h1>
                        </div>
                    You are not acces in here!!
                    <h3>Mohon Maaf Anda tidak dapat mengakses halaman ini</h3>
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