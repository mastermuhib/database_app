@extends('layouts.apps')   
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
<?php $i = Auth::user()->daerahs_id ; ?>
<?php $ds = Auth::user()->desas_id ; ?>
@if ($st >=  1 && $st <=  3 )
<div class="container" style="vertical-align: middle; position: relative;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menambahkan Kelompok Baru') }} || <a class="btn btn-danger" href="{{ route('kelompok.index') }}"> Back</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('kelompok.store') }}">
                        @csrf
                        <?php if ($st == 2 or $st == 3 ) {?>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                                    <div class="col-md-6">
                                        <select name="daerahs_id" id ="daerah" class="form-control"><option value='<?php echo $i ;?>'>please klick<?php echo $st;?></option>
                                                <option value='<?php echo $i ;?>'>please klick this tombol</option>
                                        </select>
                                    </div>
                                </div>
                        <?php }else { ?>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                                <div class="col-md-6">
                                        <select name="daerahs_id" id ="daerah" class="form-control"><option value=''>PILIH DAERAH<?php echo $st;?></option>
                                                @foreach(App\daerah::get() as $daerah)
                                                <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                                @endforeach
                                        </select>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($st == 3 ) {?>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DESA') }}</label>
                                    <div class="col-md-6">
                                        <select name="desas_id" class="form-control"><option value='<?php echo $ds ;?>'>please klick<?php echo $st;?></option>
                                                <option value='<?php echo $ds ;?>'>please klick this tombol</option>
                                        </select>
                                    </div>
                                </div>
                        <?php }else { ?>
                                <div class="form-group row">
                                     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DESA') }}</label>
                                        <div class="col-md-6">
                                            <select name="desas_id" class="form-control" id="desa">
                                            <option value=''>Pilih Desa<?php echo $i ;?></option>
                                            </select>
                                        </div>
                                </div>
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
</script>
