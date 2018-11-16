@extends('daerah.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Menambah Daerah</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ ('daerah/create') }}"> Buat Daerah Baru</a>
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
            <th>ID</th>
            <th>ID</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($daerah as $product)
        <tr>
            <td>{{ $product['id']}}</td>
            <td>{{ $product['daerah_id']}}</td>
            <td>{{ $product->name }}</td>
            <td>
                <form action="{{ route('daerah.destroy',$product['id']) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('daerah.show',$product->id) }}">Show</a>

 
    
                    <a class="btn btn-primary" href="{{ route('daerah.edit',$product->id) }}">Edit||{{ $product->id }}</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $daerah->links() !!}
      
@endsection