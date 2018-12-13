@extends('layouts.apps')
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
<?php $daerah = Auth::user()->daerahs_id ; ?>
<?php $desa = Auth::user()->desas_id ; ?>
<?php $kelompok = Auth::user()->kelompoks_id ; ?>
<?php $kelas = Auth::user()->kelas_id ; ?>
@if ($st >=  1 && $st <=  8 )
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>event</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ ('event/create') }}"> Buat event Baru</a>
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
                    <th>Name event</th>
            <?php if ($st == 1) {?>
                    <th>Daerah</th>
                    <th>Desa</th>
                    <th>Kelompok</th>
                    <th>Kelas</th>
            <?php } elseif ($st == 2) {?>
                    <th>Desa</th>
                    <th>Kelompok</th>
                    <th>Kelas</th>
            <?php } elseif ($st == 3) {?>
                    <th>Kelompok</th>
                    <th>Kelas</th>
            <?php } elseif ($st == 4) {?>
                    <th>Kategori</th>
            <?php }else { ?>
            <?php } ?>
            <th>dibuat Tanggal</th>
            <th width="280px">Action</th>
        </tr>
        <?php $no = 1; ?>
        @foreach ($event as $product)
        <?php if ( $product->daerah == NULL) {
                   $daerah = "UMUM";
             } else {
                   $daerah = $product->daerah;
             } 
        ?>
        <?php if ( $product->desa == NULL) {
                   $desa = "UMUM";
             } else {
                   $desa = $product->desa;
             } 
        ?>
        <?php if ( $product->kelompok == NULL) {
                   $kelompok = "UMUM";
             } else {
                   $kelompok = $product->kelompok;
             } 
        ?>
        <?php if ( $product->kelas == NULL) {
                   $kelas = "UMUM";
             } else {
                   $kelas = $product->kelas;
             } 
        ?>
        <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $product->name }}
                        
                    </td>
            <?php if ($st == 1) {?>
                    <td>{{ $daerah }}</td>
                    <td>{{ $desa }}</td>
                    <td>{{ $kelompok }}</td>
                    <td>{{ $kelas }}</td>
            <?php }elseif ($st == 2) { ?>
                    <td>{{ $desa }}</td>
                    <td>{{ $kelompok }}</td>
                    <td>{{ $kelas }}</td>
            <?php }elseif ($st == 3) { ?>
                    <td>{{ $kelompok }}</td>
                    <td>{{ $kelas }}</td>
            <?php }elseif ($st == 4) { ?>
                    <td>{{ $kelas }}</td>
            <?php }else { ?>
            <?php } ?>
            <td>{{ $product->date }}</td>
            <td>
                <form method="POST" action="{{ route('absensi.store') }}">
                @csrf
                 <input type="hidden" name="daerah_id" value="{{ $product->iddaerah }}">
                         <input type="hidden" name="desa_id" value="{{ $product->iddesa }}">
                         <input type="hidden" name="kelompok_id" value="{{ $product->idkelompok }}">
                         <input type="hidden" name="kelas_id" value="{{ $product->idkelas }}">
                         <input type="hidden" name="event_id" id="event_id" value="{{ $product->id }}">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action
                    <span class="fa fa-caret-down"></span></button>
                       <ul class="dropdown-menu">
                    <?php if ( $product->event > 0 && $product->status == NULL ) { ?>
                        <li><a class="btn btn-info form-control" href="{{ route('event.show',$product->id) }}">Absensi</a></li>
                    <?php } elseif ( $product->event > 0 && $product->status != NULL ) { ?>
                         <li><a class="btn btn-warning form-control" href="{{ route('absensi.show',$product->id) }}">Lihat Rekapan</a></li>
                    <?php } else { ?>
                         <li><button type="submit" id ="aktifkan" class="btn btn-success form-control">Aktifkan</button></li>
                    <?php } ?>
                </form>
                <form action="{{ route('event.destroy',$product->id) }}" method="POST">                       
                        <li><a class="btn btn-primary form-control" href="{{ route('event.edit',$product->id) }}">Edit event</a></li>
                    @csrf
                    @method('DELETE')
                        <li><button type="submit" class="btn btn-danger form-control">Delete</button></li>
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
    {{ $event->links() }}
</div>
@else
<div class="card" style="margin-top: 100px;">
                <div class="card-header">I'M  Sorry</div>

                <div class="card-body">
                        <div class="alert alert-succes" role="alert">
                           <h1> ACCES DENIED </h1>
                        </div>
                    You are not acces in here!!
                    <h3>Mohon Maaf Anda tidak dapat mengakses halaman ini</h3>
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
