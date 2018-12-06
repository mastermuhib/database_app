@extends('layouts.apps')
   
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
@if ($st ==  1)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
        </div>
        <div class="form-group row">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="daerahs_id" id="daerah">
                                      <option value='value="{{ $user->daerahs_id }}"'>Pilih daerah</option>
                                            @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach
                                </select>
                              </div>
        </div>
        <div class="form-group row">
                            <label for="desa" class="col-md-4 col-form-label text-md-right">{{ __('DESA') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="desas_id" id="desa">
                                      <option value='{{ $user->desas_id }}'>Pilih desa</option>
                                            <!-- @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach -->
                                </select>
                              </div>
        </div>
        <div class="form-group row">
                            <label for="kelompok" class="col-md-4 col-form-label text-md-right">{{ __('KELOMPOK') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="kelompoks_id" id="kelompok">
                                      <option value='{{ $user->kelompoks_id }}'>Pilih Kelompok</option>
                                            <!-- @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach -->
                                </select>
                              </div>
        </div>
        <div class="form-group row">
                            <label for="hak akses" class="col-md-4 col-form-label text-md-right">{{ __('Hak Akses') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="rules_id" id="rules_id">
                                      <option value=''>Pilih Hak Akses</option>
                                      <option value='1'>super admin</option>
                                      <option value='2'>admin daerah</option>
                                      <option value='3'>admin desa</option>
                                      <option value='4'>admin kelompok</option>
                                </select>
                              </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="{{ asset('js/jquery.js')}}"></script>
<script>        
   $(document).ready(function() {
       $('#daerah').on('change',function(){
           var daerah = $(this).val(); 
           if (daerah) {
                console.log(daerah)
                $.ajax({
                    url: '/getdesa/' + daerah,
                    type: 'GET',
                    dataType: 'json', // Data yang akan dikirim ke file pemroses
                    success: function(data) { // Jika berhasil
                        console.log(data)
                        $(".list-desa").remove()
                        for (var i = data.length - 1; i >= 0; i--) {
                            $("#desa").append('<option class="list-desa" value="'+data[i].id+'">'+data[i].name+'</option>')
                        } 
                    }
               });
           }
        });
    }); 

   $(document).ready(function() {
       $('#desa').on('change',function(){
           var desa = $(this).val(); 
           if (desa) {
                console.log(desa)
                $.ajax({
                    url: '/getkelompok/' + desa,
                    type: 'GET',
                    dataType: 'json', // Data yang akan dikirim ke file pemroses
                    success: function(data) { // Jika berhasil
                        console.log(data)
                        $(".list-kelompok").remove()
                        for (var i = data.length - 1; i >= 0; i--) {
                            $("#kelompok").append('<option class="list-kelompok" value="'+data[i].id+'">'+data[i].name+'</option>')
                        } 
                    }
               });
           }
        });
    }); 
</script>
