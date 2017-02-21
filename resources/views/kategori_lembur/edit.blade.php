@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Edit Data Kategori Lembur</div>
                <div class="panel-body">
				<hr>
				{!! Form::model($kategori_lembur, ['method' => 'PATCH', 'route' => ['katelembur.update', $kategori_lembur->id], 'class' => 'form-horizontal']) !!}
					<div class="form-group{{ $errors->has('Kode_lebur') ? ' has-error' : '' }}">
	                    <label for="Kode_lebur" class="col-md-4 control-label">Kode Jabatan</label>
						<div class="col-md-6">
	                        <input type="text" name="Kode_lebur" class="form-control" value="{{ $kategori_lembur->Kode_lebur }}" readonly>
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
	                        <input type="number" name="Besaran_uang" class="form-control" value="{{ $kategori_lembur->Besaran_uang }}">
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
	   </div>
    </div>
</div> 	
@endsection