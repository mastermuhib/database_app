@extends('layouts.apps')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Kelas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ ('kelas/create') }}"> Buat kelas Baru</a>
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
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="search" style="float: right;" />
    <table class="order-table table table-bordered">
        <tr>
            <th>NOMOR</th>
            <th>Name kelas</th>
            <th width="280px">Action</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($kelas as $product)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $product->name }}</td>
            <td>
                <form action="{{ route('kelas.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('kelas.show',$product->id) }}">Show</a>

 
    
                    <a class="btn btn-primary" href="{{ route('kelas.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php $no++; ?>
        @endforeach
    </table>
<div style="padding-top: 10px;">
    {{ $kelas->links() }}
</div>
@endsection