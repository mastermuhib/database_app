@extends('layouts.apps') 
@section('content')
<div class="container" style="vertical-align: middle; position: relative;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menambahkan User baru') }} || <a class="btn btn-danger" href="{{ route('users.index') }}"> Back</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="daerahs_id" id="daerah">
                                      <option value=''>Pilih Daerah</option>
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
                                      <option value=''>Pilih desa</option>
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
                                      <option value=''>Pilih Kelompok</option>
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


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('TAMBAH') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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