@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                    <h4 class="title">Tambah Data</h4>
                    <p class="category">Golongan</p>
                </div>
                <div class="content">
                    {!!Form::open(['route' => 'golongan.store', 'class' => 'form-horizontal']) !!}
						<div class="form-group{{ $errors->has('Kode_golongan') ? ' has-error' : '' }}">
                            <label for="Kode_golongan" class="col-md-4 control-label">Kode Golongan</label>
							<div class="col-md-6">
                                <input id="Kode_golongan" type="text" class="form-control" name="Kode_golongan" value="{{ $kode }}" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('Nama_golongan') ? ' has-error' : '' }}">
                            <label for="Nama_golongan" class="col-md-4 control-label">Nama Golongan</label>
                            <div class="col-md-6">
                                <input id="Nama_golongan" type="text" class="form-control" name="Nama_golongan" value="{{ old('Nama_golongan') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Besaran_uang') ? ' has-error' : '' }}">
                            <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
                            <div class="col-md-6">
                                <input id="Besaran_uang" type="number" class="form-control" name="Besaran_uang" value="{{ old('Besaran_uang') }}" required autofocus>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
                            </div>
                        </div>
					{!! Form::close() !!}
	           </div>
	       </div>
@endsection