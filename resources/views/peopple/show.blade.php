@extends('layouts.apps')

@section('content')
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
@endsection