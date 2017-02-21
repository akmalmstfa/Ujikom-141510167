@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Lihat Data Jabatan</div>
                <div class="panel-body">
                <hr>
                    <form class="form-horizontal">
						<div class="form-group{{ $errors->has('Kode_jabatan') ? ' has-error' : '' }}">
                            <label for="Kode_jabatan" class="col-md-4 control-label">Kode Jabatan</label>
							<div class="col-md-6">
                                <input id="Kode_jabatan" type="text" class="form-control" name="Kode_jabatan" value="{{ $jabatan->Kode_jabatan }}" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('Nama_jabatan') ? ' has-error' : '' }}">
                            <label for="Nama_jabatan" class="col-md-4 control-label">Nama Jabatan</label>
                            <div class="col-md-6">
                                <input id="Nama_jabatan" type="text" class="form-control" name="Nama_jabatan" value="{{ $jabatan->Nama_jabatan }}" readonly required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Besaran_uang') ? ' has-error' : '' }}">
                            <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
                            <div class="col-md-6">
                                <input id="Besaran_uang" type="text" class="form-control" name="Besaran_uang" value="<?php echo 'Rp. '.number_format($jabatan->Besaran_uang, 2, ",", "."); ?>" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/jabatan" type="submit" class="btn btn-primary">
                                    Kembali
                                </a>
                            </div>
                        </div>
					</form>
	           </div>
	       </div>
	   </div>
    </div>
</div> 	
@endsection