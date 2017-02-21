@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Tambah Data Kategori Lembur</div>
                <div class="panel-body">
                <hr>
                    {!!Form::open(['route' => 'katelembur.store', 'class' => 'form-horizontal']) !!}
						<div class="form-group{{ $errors->has('Kode_lembur') ? ' has-error' : '' }}">
                            <label for="Kode_lembur" class="col-md-4 control-label">Kode Jabatan</label>
							<div class="col-md-6">
                                <input id="Kode_lembur" type="text" class="form-control" name="Kode_lembur" value="{{ $kode }}" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            <label for="jabatan_id" class="col-md-4 control-label">Nama Jabatan</label>
                            <div class="col-md-6">
                                <select name="jabatan_id" class="form-control">
                                    @foreach($jabatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->Nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            <label for="golongan_id" class="col-md-4 control-label">Nama Golongan</label>
                            <div class="col-md-6">
                                <select name="golongan_id" class="form-control">
                                    @foreach($golongan as $data)
                                        <option value="{{ $data->id }}">{{ $data->Nama_golongan }}</option>
                                    @endforeach
                                </select>
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
	   </div>
    </div>
</div> 	
@endsection