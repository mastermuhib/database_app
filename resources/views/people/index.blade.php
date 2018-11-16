@extends('people.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Menambah people</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ ('people/create') }}"> Buat people Baru</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>NOMOR</th>
            <th>Name Daerah</th>
            <th>Name Desa</th>
            <th>Name Kelompok</th>
            <th>Name people</th>
            <th width="280px">Action</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($people as $product)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $product->name1 }}</td>
            <td>{{ $product->name2 }}</td>
            <td>{{ $product->name3 }}</td>
            <td>{{ $product->name4 }}</td>
            <td>
                <form action="{{ route('people.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('people.show',$product->id) }}">Show</a>

 
    
                    <a class="btn btn-primary" href="{{ route('people.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php $no++; ?>
        @endforeach
    </table>
@endsection