@extends('layouts.apps')   
@section('content')
@if (Route::has('login'))
@auth
<?php $st = Auth::user()->rules_id ; ?>
<?php $i = Auth::user()->daerahs_id ; ?>
<div class="container" style="vertical-align: middle; position: relative;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menambahkan Desa Baru') }} || <a class="btn btn-danger" href="{{ route('desa.index') }}"> Back</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('desa.store') }}">
                        @csrf
                        <?php if ($st == 2 ) {?>
                                <div class="d-lg-none">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                                    <div class="col-md-6">
                                        <select name="daerahs_id" class="form-control"><option value='<?php echo $i ;?>'>PILIH DAERAH</option>
                                                <option value='<?php echo $i ;?>'><?php echo $i ;?></option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                        <?php }else { ?>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DAERAH') }}</label>
                                <div class="col-md-6">
                                        <select name="daerahs_id" class="form-control"><option value=''>PILIH DAERAH<?php echo $st;?></option>
                                                @foreach(App\daerah::get() as $daerah)
                                                <option value='{{ $daerah->id }}'>{{ $daerah->name }}</option>
                                                @endforeach
                                        </select>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('TAMBAH') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endif
@endsection