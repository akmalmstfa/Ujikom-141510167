@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Lihat Data Kategori Lembur</div>
                <div class="panel-body">
                <hr>
						<div class="form-group{{ $errors->has('Kode_lembur') ? ' has-error' : '' }}">
                            <label for="Kode_lembur" class="col-md-4 control-label">Kode Jabatan</label>
							<div class="col-md-6">
                                <input id="Kode_lembur" type="text" class="form-control" name="Kode_lembur" value="{{ $kategori_lembur->Kode_lembur }}" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            <label for="jabatan_id" class="col-md-4 control-label">Nama Jabatan</label>
                            <div class="col-md-6">
                                <input id="jabatan_id" type="text" class="form-control" name="jabatan_id" value="{{ $kategori_lembur->Jabatan->Nama_jabatan }}" readonly required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            <label for="golongan_id" class="col-md-4 control-label">Nama Golongan</label>
                            <div class="col-md-6">
                                <input id="golongan_id" type="text" class="form-control" name="golongan_id" value="{{ $kategori_lembur->Golongan->Nama_golongan }}" readonly required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Besaran_uang') ? ' has-error' : '' }}">
                            <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
                            <div class="col-md-6">
                                <input id="Besaran_uang" type="text" class="form-control" name="Besaran_uang" value="<?php echo 'Rp. '.number_format($kategori_lembur->Besaran_uang, 2, ",", "."); ?>" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/katelembur" type="submit" class="btn btn-primary">
                                    Kembali
                                </a>
                            </div>
                        </div>
	           </div>
	       </div>
	   </div>
    </div>
</div> 	
@endsection