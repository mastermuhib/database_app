@extends('layouts.apps') 
@section('content')
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
<link rel="stylesheet" href="{{asset('assets/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> 

    <table class="table hover table-bordered" id="table_id">
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
          <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>Hak Akses</th>
            <th >Action</th>
          </tr>
          <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>Hak Akses</th>
            <th >Action</th>
          </tr>
          <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>Hak Akses</th>
            <th >Action</th>
          </tr>
          <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>Hak Akses</th>
            <th >Action</th>
          </tr>
          <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>Hak Akses</th>
            <th >Action</th>
          </tr>
            
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>name</th>
                <th>email</th>
                <th>Hak Akses</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table> 
<div style="padding-top: 50px;">
</div> 
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
      'autoWidth'   : false
    })
  })
</script>
@stop