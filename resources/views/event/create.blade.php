@extends('layouts.apps') 
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
<?php $id = Auth::user()->id ; ?>
<?php $daerah = Auth::user()->daerahs_id ; ?>
<?php $desa = Auth::user()->desas_id ; ?>
<?php $kelompok = Auth::user()->kelompoks_id ; ?>
<?php $kelas = Auth::user()->kelas_id ; ?>
@if ($st >=  1 && $st <=  7 )
<div class="container" style="vertical-align: middle; position: relative;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menambahkan events') }} || <a class="btn btn-danger" href="{{ route('event.index') }}"> Back</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('event.store') }}">
                        @csrf

                        <div class="form-group row d-none">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="user_id" type="text" class="form-control" name="user_id" value="<?php echo $id;?>">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <?php if ($st == 1) { ?>
                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>
                                          <div class="col-md-6"> 
                                                <select name="derahs_id" id="daerah" class="form-control">
                                                    <option value=''>Umum</option>
                                                        <option value='' style="background-color: yellow;" disabled="disabled"><center>--atau pilih kota--</center></option>
                                                           @foreach(App\daerah::get() as $daerah)
                                                           <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                                           @endforeach
                                                </select>
                                          </div>
                        </div>
                        <?php } else { ?>
                        <div class="form-group row d-none">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('daerah id') }}</label>

                            <div class="col-md-6">
                                <input id="daerah_id" type="hidden" class="form-control" name="daerahs_id" value="<?php echo $daerah;?>">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($st == 1) { ?>
                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                                          <div class="col-md-6"> 
                                            <select name="desas_id" class="form-control" id="desa">
                                            <option value=''>Umum satu Daerah</option>
                                            </select>
                                          </div>
                        </div>
                        <?php } elseif ($st == 2) { ?>
                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>
                                          <div class="col-md-6"> 
                                                <select name="desas_id" id="desa" class="form-control">
                                                    <option value=''>Umum</option>
                                                      <?php $desas = DB::table('desas')->where('daerahs_id','=', $daerah)->get(); ?>
                                                          @foreach($desas as $product)
                                                          <option value='{{ $product->id }}'>{{ $product->name }}</option>
                                                          @endforeach
                                                </select>
                                          </div>
                        </div>
                        <?php } else { ?>
                        <div class="form-group row d-none">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('desa id') }}</label>

                            <div class="col-md-6">
                                <input id="desa_id" type="text" class="form-control" name="desas_id" value="<?php echo $desa;?>">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($st == 1 or $st == 2) { ?>
                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                                          <div class="col-md-6"> 
                                            <select name="kelompoks_id" class="form-control" id="kelompok">
                                            <option value=''>Umum satu desa</option>
                                            </select>
                                          </div>
                        </div>
                        <?php } elseif ($st == 3) { ?>
                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>
                                          <div class="col-md-6"> 
                                                <select name="kelompoks_id" id="kelompok" class="form-control">
                                                    <option value=''>Umum</option>
                                                      <?php $kelompok = DB::table('kelompoks')->where('desas_id','=', $desa)->get(); ?>
                                                          @foreach($kelompok as $product)
                                                          <option value='{{ $product->id }}'>{{ $product->name }}</option>
                                                          @endforeach
                                                </select>
                                          </div>
                        </div>
                        <?php } else { ?>
                        <div class="form-group row d-none">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('kelompok id') }}</label>

                            <div class="col-md-6">
                                <input id="kelompok_id" type="text" class="form-control" name="kelompoks_id" value="<?php echo $kelompok;?>">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($st >= 1 && $st <= 3) { ?>
                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                                          <div class="col-md-6"> 
                                            <select name="kelas_id" class="form-control" id="kelas">
                                            <option value=''>Umum satu Kelompok</option>
                                            </select>
                                          </div>
                        </div>
                        <?php } elseif ($st == 4) { ?>
                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>
                                          <div class="col-md-6"> 
                                                <select name="kelas_id" class="form-control">
                                                    <option value=''>Umum</option>
                                                      <?php $kelas = DB::table('kelas')->where('kelompoks_id','=', $kelompok)->get(); ?>
                                                          @foreach($kelas as $product)
                                                          <option value='{{ $product->id }}'>{{ $product->name }}</option>
                                                          @endforeach
                                                </select>
                                          </div>
                        </div>
                        <?php } else { ?>
                        <input type="hidden" name="kelas_id" class="form-control" value="<?php echo $kelas;?>" placeholder="Name">
                        <?php } ?>
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
   $(document).ready(function() {
       $('#kelompok').on('change',function(){
           var kelas = $(this).val(); 
           if (kelas) {
                console.log(kelas)
                $.ajax({
                    url: '/getkelas/' + kelas,
                    type: 'GET',
                    dataType: 'json', // Data yang akan dikirim ke file pemroses
                    success: function(data) { // Jika berhasil
                        console.log(data)
                        $(".list-kelas").remove()
                        for (var i = data.length - 1; i >= 0; i--) {
                            $("#kelas").append('<option class="list-kelas" value="'+data[i].id+'">'+data[i].name+'</option>')
                        } 
                    }
               });
           }
        });
    }); 
</script>
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