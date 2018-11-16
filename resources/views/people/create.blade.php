@extends('people.layout')  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>tambah people baru</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('people.index') }}"> Back</a>
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
   
<form action="{{ route('people.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">PILIH DAERAH
    <select name="daerahs_id">
        @foreach(App\daerah::get() as $daerah)
           <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
        @endforeach
    </select>
            </div>
             <div class="form-group">PILIH DESA
    <select name="desas_id">
        @foreach(App\desa::get() as $desa)
           <option value='{{ $desa->id }}'>{{ $desa->name }}</option>
        @endforeach
    </select>
            </div>
            <div class="form-group">PILIH Kelompok
    <select name="kelompoks_id">
        @foreach(App\kelompok::get() as $kelompok)
           <option value='{{ $kelompok->id }}'>{{ $kelompok->name }}</option>
        @endforeach
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
<script type="text/javascript">  
        $('#datepicker').datepicker({ 
            autoclose: true,   
            format: 'dd-mm-yyyy'  
         });  
    </script>