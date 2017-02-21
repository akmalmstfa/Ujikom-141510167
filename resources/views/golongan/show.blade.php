@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Lihat Data Golongan</div>
                <div class="panel-body">
                <hr>
                    <form class="form-horizontal">
						<div class="form-group{{ $errors->has('Kode_golongan') ? ' has-error' : '' }}">
                            <label for="Kode_golongan" class="col-md-4 control-label">Kode Golongan</label>
							<div class="col-md-6">
                                <input id="Kode_golongan" type="text" class="form-control" name="Kode_golongan" value="{{ $golongan->Kode_golongan }}" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('Nama_golongan') ? ' has-error' : '' }}">
                            <label for="Nama_golongan" class="col-md-4 control-label">Nama Golongan</label>
                            <div class="col-md-6">
                                <input id="Nama_golongan" type="text" class="form-control" name="Nama_golongan" value="{{ $golongan->Nama_golongan }}" readonly required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Besaran_uang') ? ' has-error' : '' }}">
                            <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
                            <div class="col-md-6">
                                <input id="Besaran_uang" type="text" class="form-control" name="Besaran_uang" value="<?php echo 'Rp. '.number_format($golongan->Besaran_uang, 2, ",", "."); ?>" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/golongan" type="submit" class="btn btn-primary">
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