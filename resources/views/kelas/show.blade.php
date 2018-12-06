@extends('layouts.apps')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>People In Class</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/kelas"> Back</a>
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
            <th>Name peopple</th>
            <th>Alamat</th>
            <th>Name Daerah</th>
            <th>Name Desa</th>
            <th>Name Kelompok</th>
            <th>Kelas</th>
            <th>Action</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($peopples as $product)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $product->name4 }}</td>
            <td>{{ $product->alamat }}</td>
            <td>{{ $product->name1 }}</td>
            <td>{{ $product->name2 }}</td>
            <td>{{ $product->name3 }}</td>
            <td>{{ $product->name5 }}</td>
            <td>
                <form action="{{ route('peopple.destroy',$product->id) }}" method="POST">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action
                        <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <li><a class="btn btn-info form-control" href="{{ route('peopple.show',$product->id) }}">Show</a></li>
                        <li><a class="btn btn-primary form-control" href="{{ route('peopple.edit',$product->id) }}">Edit</a></li>
                    @csrf
                    @method('DELETE')
                        <li><button type="submit" class="btn btn-danger form-control">Delete</button></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                  </div>
                </form>
            </td>
        </tr>
        <?php $no++; ?>
        @endforeach
    </table>
<div style="padding-top: 10px;">
    {{ $peopples->links() }}
</div>
@endsection