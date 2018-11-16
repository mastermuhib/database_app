@extends('layouts.apps') 
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>tambah kelompok baru</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kelompok.index') }}"> Back</a>
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
   
<form action="{{ route('kelompok.store') }}" method="POST">
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
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
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
</script>