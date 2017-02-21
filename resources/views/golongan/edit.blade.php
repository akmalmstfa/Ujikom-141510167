@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                	<div class="title">Edit Data</div>
                	<p class="category">Golongan</p>
                </div>
                <div class="content">
				{!! Form::model($golongan, ['method' => 'PATCH', 'route' => ['golongan.update', $golongan->id], 'class' => 'form-horizontal']) !!}
					<div class="form-group{{ $errors->has('Kode_golongan') ? ' has-error' : '' }}">
	                    <label for="Kode_golongan" class="col-md-4 control-label">Kode Golongan</label>
						<div class="col-md-6">
	                        <input type="text" name="Kode_golongan" class="form-control" value="{{ $golongan->Kode_golongan }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group{{ $errors->has('Nama_golongan') ? ' has-error' : '' }}">
	                    <label for="Nama_golongan" class="col-md-4 control-label">Nama Golongan</label>
						<div class="col-md-6">
	                        <input type="text" name="Nama_golongan" class="form-control" value="{{ $golongan->Nama_golongan }}">
	                    </div>
	                </div>
	                <div class="form-group{{ $errors->has('Besaran_uang') ? ' has-error' : '' }}">
	                    <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
						<div class="col-md-6">
	                        <input type="number" name="Besaran_uang" class="form-control" value="{{ $golongan->Besaran_uang }}">
	                    </div>
	                </div>
					<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
					{!! Form::close() !!}
	           </div>
	       </div>
@endsection