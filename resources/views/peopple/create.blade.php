@extends('peopple.layout')  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>tambah peopple baru</h2>
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
   
<form action="{{ route('peopple.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">PILIH DAERAH
                    <select name="daerahs_id" id="daerah">
                    <option value="">Pilih Daerah</option>
                    @foreach(App\daerah::get() as $daerah)
                        <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                    @endforeach
                    </select>
            </div>
            <div class="form-group">PILIH DESA
                <select name="desas_id" id="desa">
                    <option value=''>Pilih Desa</option>
                </select>
            </div>
            <div class="form-group">Kelompok
                <select name="kelompoks_id" id="kelompok">
                    <option value=''>Pilih kelompok</option>
                </select>
            </div>
        <div class="form-group">
             <strong>Name:</strong>
             <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <!--  -->
        <div class="form-group">
              <label for="addres">Address:</label>
              <input type="text" class="form-control" name="addres">
        </div>
        <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="text" class="form-control" name="phone">
        </div>
        <div class="form-group">
              <label for="birthday">birthday:</label>
              <input class="date form-control"  type="date" id="datepicker" name="birthday"> 
        </div>
        <div class="form-group">PILIH STATUS
              <select name="status">
                      <option value=''>Pilih status</option>
                      <option value="Dewasa">Dewasa</option>
                      <option value="Remaja">Remaja</option>
                      <option value="Anak-Anak">Anak-Anak</option>      
              </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
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