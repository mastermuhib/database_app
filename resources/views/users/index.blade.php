@extends('layouts.apps') 
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
@if ($st ==  1)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Menambah user</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ ('users/create') }}"> Buat user Baru</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<script type="text/javascript" async="" src="{{asset('assets/js/search.js')}}"></script>
<script type="text/javascript" async="" src="{{asset('assets/DataTables/datatables.js')}}"></script>   
<script type="text/javascript" async="" src="{{asset('assets/DataTables/datatables.css')}}"></script>   
<script type="text/javascript" async="" src="{{asset('assets/DataTables/datatables.min.js')}}"></script>   
<script type="text/javascript" async="" src="{{asset('assets/DataTables/datatables.min.css')}}"></script> 
<link rel="stylesheet" href="{{asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> 
 <script type="text/javascript" async="" src="{{asset('assets/js/search.js')}}"></script>   
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="search" style="float: right;" />
    <table class="order-table table table-bordered"s>
        <thead>
        <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>Hak Akses</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($user as $product)
            <?php if ($product->rules_id == 1) {
            $akses = "super admin";
              } elseif ($product->rules_id == 2) {
            $akses = "admin daerah";
              } elseif ($product->rules_id == 3) {
            $akses = "admin desa";
              } elseif ($product->rules_id == 4) {
            $akses = "admin kelompok";
        } elseif ($product->rules_id == 5) {
            $akses = "guru";
              } else {
            $akses = "anggota baru";   
              }
            ?>
                 <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->email}}</td>
                    <td>{{ $akses}}</td>
                    <td>
                        <form action="{{ route('users.destroy',$product->id) }}" method="POST">
           
                            <a class="btn btn-info" href="{{ route('users.show',$product->id) }}">Show</a>

         
            
                            <a class="btn btn-primary" href="{{ route('users.edit',$product->id) }}">Edit</a>
           
                            @csrf
                            @method('DELETE')
              
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php $no++; ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>name</th>
                <th>email</th>
                <th>Hak Akses</th>
                <th width="280px">Action</th>
            </tr>
        </tfoot>
    </table> 
<div style="padding-top: 50px;">
    {{ $user->links() }}
</div>
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
@section('script')
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/jquery.js')}}"></script> 
<script src="{{asset('assets/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#table_id').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
    })
  })
</script>
@stop