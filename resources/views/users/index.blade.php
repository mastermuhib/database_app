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
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>Hak Akses</th>
            <th width="280px">Action</th>
        </tr>
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
    </table> 
<div style="padding-top: 50px;">
    {{ $user->links() }}
</div>      
@endsection