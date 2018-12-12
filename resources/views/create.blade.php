@extends('layouts.apps') 
@section('content')
<?php use Illuminate\Support\Facades\DB; ?>
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
<?php $i = Auth::user()->daerahs_id ; ?>
<?php $ds = Auth::user()->desas_id ; ?>
<?php $kl = Auth::user()->kelompoks_id ; ?>
<?php $kelas = Auth::user()->kelas_id ; ?>
@if ($st >=  1 && $st <=  7)
<div class="container" style="vertical-align: middle; position: relative;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">{{ __('Menambahkan Poeple baru') }} || <a class="btn btn-danger" href="{{ route('peopple.index') }}"> Back</a></div>
                <div class="card-body">
                                <form action="{{ route('peopple.store') }}" method="POST">
                                    @csrf
                       <?php if ($st == 1 ) {?>
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
                        <?php }else { ?>
                               <input type="hidden" name="daerahs_id" class="form-control" value="<?php echo $i ;?>" placeholder="Name">
                        <?php } ?>
                        <?php if ($st == 2 ) {?>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DESA') }}</label>
                                    <div class="col-md-6">
                                        <select name="desas_id" id="desa" class="form-control"><option value=''>Pilih Desa</option>
                                                <?php $desa = DB::table('desas')->where('daerahs_id','=', $i)->get(); ?>
                                                          @foreach($desa as $product)
                                                          <option value='{{ $product->id }}'>{{ $product->name }}</option>
                                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                        <?php }else { ?>
                                       <input type="hidden" name="desas_id" class="form-control" value="<?php echo $ds ;?>" placeholder="Name">
                         <?php } ?> 
                         <?php if ($st == 2 ) {?>
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
                         <?php } elseif ($st == 3 ) {?>
                              <div class="">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kelompok') }}</label>
                                          <div class="col-md-6"> 
                                                <select name="kelompoks_id" class="form-control"><option value=''>Pilih Kelompok</option>
                                                   <?php $kelompok = DB::table('kelompoks')->where('desas_id','=', $ds)->get(); ?>
                                                          @foreach($kelompok as $product)
                                                          <option value='{{ $product->id }}'>{{ $product->name }}</option>
                                                          @endforeach
                                                </select>
                                          </div>
                                    </div>
                              </div>
                         <?php }else { ?>
                                       <input type="hidden" name="kelompoks_id" class="form-control" value="<?php echo $kl ;?>" placeholder="Name">
                         <?php } ?>
                         <?php if ($st == 4 ) {?>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kelas') }}</label>
                                          <div class="col-md-6"> 
                                                <select name="kelas_id" class="form-control">
                                                    <option value=''>Pilih kelas</option>
                                                      <?php $kelas = DB::table('kelas')->where('kelompoks_id','=', $kl)->get(); ?>
                                                          @foreach($kelas as $product)
                                                          <option value='{{ $product->id }}'>{{ $product->name }}</option>
                                                          @endforeach
                                                </select>
                                          </div>
                                    </div>
                         <?php } elseif ($st == 5 ) {?>
                                       <input type="text" name="kelas_id" class="form-control" value="<?php echo $kelas ;?>" placeholder="Name">
                         <?php }else { ?>

                         <?php } ?>  
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                          <div class="col-md-6"> 
                                             <input type="text" name="name" class="form-control" placeholder="Name">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Addres') }}</label>
                                          <div class="col-md-6"> 
                                              <input type="text" class="form-control" name="addres">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                                          <div class="col-md-6"> 
                                              <input type="text" class="form-control" name="phone">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>
                                          <div class="col-md-6"> 
                                              <input class="date form-control"  type="date" id="datepicker" name="birthday"> 
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                          <div class="col-md-6"> 
                                              <select name="status" class="form-control">
                                                      <option value=''>Pilih status</option>
                                                      <option value="Dewasa">Dewasa</option>
                                                      <option value="Remaja">Remaja</option>
                                                      <option value="Anak-Anak">Anak-Anak</option>      
                                              </select>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="posisi" class="col-md-4 col-form-label text-md-right">{{ __('Posisi') }}</label>
                                          <div class="col-md-6"> 
                                              <select name="posisi" class="form-control">
                                                      <option value=''>Pilih Posisi</option>
                                                      <option value="1">guru</option>
                                                      <option value="2">murid</option>
                                                      <option value="3">Netral</option>      
                                              </select>
                                          </div>
                                    </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>                                   
                                </form>
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