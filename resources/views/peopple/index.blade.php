@extends('layouts.apps')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Menambah peopple</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ ('peopple/create') }}"> Buat peopple Baru</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<script type="text/javascript" async="" src="{{asset('assets/js/search.js')}}"></script>   
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="search" style="float: right;" />
    <table class="order-table table table-bordered">
        <tr>
            <th>NOMOR</th>
            <th>Name peopple</th>
            <th>Alamat</th>
            <th>Name Daerah</th>
            <th>Name Desa</th>
            <th>Name Kelompok</th>
            <th width="280px">Action</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($peopple as $product)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $product->name4 }}</td>
            <td>{{ $product->alamat }}</td>
            <td>{{ $product->name1 }}</td>
            <td>{{ $product->name2 }}</td>
            <td>{{ $product->name3 }}</td>
            <td>
                <form action="{{ route('peopple.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('peopple.show',$product->id) }}">Show</a>

 
    
                    <a class="btn btn-primary" href="{{ route('peopple.edit',$product->id) }}">Edit</a>
   
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
    {{ $peopple->links() }}
</div>
@endsection