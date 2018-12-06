@extends('layouts.apps')  
@section('content')
@if (Route::has('login'))
@auth
<?php $r = Auth::user()->rules_id ; ?>
<?php $i = Auth::user()->kelompoks_id ; ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Peoples</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('peopple.index') }}"> Back</a>
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
  
     <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group row">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>
                              <div class="col-md-6">
                                 <input type="text" id="people_id" name="people_id" value="{{ $peopple->id }}" class="form-control" placeholder="Name" readonly="true">
                              </div>
        </div>
        <div class="form-group row">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                              <div class="col-md-6">
                                 <input type="text" id="name" name="name" value="{{ $peopple->name }}" class="form-control" placeholder="Name" readonly="true">
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
    <?php if ($r == 1) { ?>
        <div class="form-group row d-none">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="daerahs_id" id="daerah">
                                      <option value='{{ $peopple->daerahs_id }}'>{{ $peopple->daerahs_id }}</option>
                                            @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach
                                </select>
                              </div>
        </div>
    <?php } else { ?>
        <div class="form-group row d-none">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="daerahs_id" id="daerah">
                                      <option value='{{ $peopple->daerahs_id }}'>{{ $peopple->daerahs_id }}</option>
                                            @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach
                                </select>
                              </div>
        </div>
    <?php } ?>
    <?php if ($r == 1) { ?>
        <div class="form-group row d-none">
                            <label for="desa" class="col-md-4 col-form-label text-md-right">{{ __('DESA') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="desas_id" id="desa">
                                      <option value='{{ $peopple->desas_id }}'>{{ $peopple->desas_id }}</option>
                                            <!-- @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach -->
                                </select>
                              </div>
        </div>
    <?php } else { ?>
        <div class="form-group row d-none">
                            <label for="desa" class="col-md-4 col-form-label text-md-right">{{ __('DESA') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="desas_id" id="desa">
                                      <option value='{{ $peopple->desas_id }}'>{{ $peopple->desas_id }}</option>
                                            <!-- @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach -->
                                </select>
                              </div>
        </div>
    <?php } ?>
    <?php if ($r == 1) { ?>
         <div class="form-group row d-none">
                            <label for="kelompok" class="col-md-4 col-form-label text-md-right">{{ __('KELOMPOK') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="kelompoks_id" id="kelompok">
                                      <option value='{{ $peopple->kelompoks_id }}'>{{ $peopple->kelompoks_id }}</option>
                                            <!-- @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach -->
                                </select>
                              </div>
        </div>
    <?php } else { ?>
         <div class="form-group row d-none">
                            <label for="kelompok" class="col-md-4 col-form-label text-md-right">{{ __('KELOMPOK') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="kelompoks_id" id="kelompok">
                                      <option value='{{ $peopple->kelompoks_id }}'>Pilih Kelompok</option>
                                            <!-- @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach -->
                                </select>
                              </div>
        </div>
    <?php } ?>
        <div class="form-group row">
                            <label for="hak akses" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="rules_id" id="rules_id">
                                      <option value='{{ $peopple->posisi }}'>Pilih Posisi</option>
                                      <option value='5'>Guru</option>
                                      <option value='6'>Murid</option>
                                      <option value='7'>Netral</option>
                                </select>
                              </div>
        </div>
        <div class="form-group row">
                            <label for="hak akses" class="col-md-4 col-form-label text-md-right">{{ __('Kelas') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="kelas_id" id="kelas">
                                      <option value='{{ $peopple->kelas_id }}'>{{ $peopple->kelas_id }}</option>
                                      @foreach(App\kelas::get() as $kelas)
                                      <option value='{{ $kelas->id }}'>{{ $kelas->name }}</option>
                                      @endforeach
                                </select>
                              </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
        </div>
   
    </form>

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