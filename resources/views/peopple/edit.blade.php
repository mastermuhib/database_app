@extends('layouts.apps')  
@section('content')
@if (Route::has('login'))
@auth
<?php $r = Auth::user()->rules_id ; ?>
<?php $i = Auth::user()->kelompoks_id ; ?>
@if ($r >=  1 && $r <=  4 )
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
  
    <form action="{{ route('peopple.update',$peopple['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                              <div class="col-md-6">
                                 <input type="text" name="name" value="{{ $peopple->name }}" class="form-control" placeholder="Name">
                              </div>
        </div>
    <?php if ($r == 1) { ?>
        <div class="form-group row">
                            <label for="daerah" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="daerahs_id" id="daerah">
                                      <option value='{{ $peopple->daerahs_id }}'>Pilih Daerah</option>
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
                                      <option value='{{ $peopple->daerahs_id }}'>Pilih Daerah</option>
                                            @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach
                                </select>
                              </div>
        </div>
    <?php } ?>
    <?php if ($r == 1) { ?>
        <div class="form-group row">
                            <label for="desa" class="col-md-4 col-form-label text-md-right">{{ __('DESA') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="desas_id" id="desa">
                                      <option value='{{ $peopple->desas_id }}'>Pilih desa</option>
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
                                      <option value='{{ $peopple->desas_id }}'>Pilih desa</option>
                                            <!-- @foreach(App\daerah::get() as $daerah)
                                            <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                            @endforeach -->
                                </select>
                              </div>
        </div>
    <?php } ?>
    <?php if ($r == 1) { ?>
         <div class="form-group row">
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
                            <label for="Addres" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                              <div class="col-md-6">
                                 <input type="text" name="addres" value="{{ $peopple->addres }}" class="form-control" placeholder="addres">
                              </div>
        </div>
        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                              <div class="col-md-6">
                                 <input type="text" name="status" value="{{ $peopple->status }}" class="form-control" placeholder="status">
                              </div>
        </div>
        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                              <div class="col-md-6">
                                 <input type="text" name="phone" value="{{ $peopple->phone }}" class="form-control" placeholder="phone">
                              </div>
        </div>
        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>
                              <div class="col-md-6">
                                <input type="date" name="birthday" value="{{ $peopple->birthday }}" class="form-control" placeholder="birthday">
                              </div>
        </div>
        <div class="form-group row">
                            <label for="hak akses" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="posisi" id="posisi">
                                      <option value='{{ $peopple->posisi }}'>Pilih Posisi</option>
                                      <option value='1'>Guru</option>
                                      <option value='2'>Murid</option>
                                      <option value='3'>Netral</option>
                                </select>
                              </div>
        </div>
        <div class="form-group row">
                            <label for="hak akses" class="col-md-4 col-form-label text-md-right">{{ __('Kelas') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" name="kelas_id" id="kelas">
                                      <option value='{{ $peopple->kelas_id }}'>Pilih Kelas</option>
                                      <?php $kelas = DB::table('kelas')->where('kelompoks_id','=', $i)->get(); ?>
                                      @foreach($kelas as $product)
                                      <option value='{{ $product->id }}'>{{ $product->name }}</option>
                                      @endforeach
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