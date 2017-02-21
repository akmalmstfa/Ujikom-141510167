@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                	<div class="title">Edit Data</div>
                	<p class="category">Jabatan</p>
                </div>
                <div class="content">
				<hr>
				{!! Form::model($jabatan, ['method' => 'PATCH', 'route' => ['jabatan-hrd.update', $jabatan->id], 'class' => 'form-horizontal']) !!}
					<div class="form-group{{ $errors->has('Kode_jabatan') ? ' has-error' : '' }}">
	                    <label for="Kode_jabatan" class="col-md-4 control-label">Kode Jabatan</label>
						<div class="col-md-6">
	                        <input type="text" name="Kode_jabatan" class="form-control" value="{{ $jabatan->Kode_jabatan }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group{{ $errors->has('Nama_jabatan') ? ' has-error' : '' }}">
	                    <label for="Nama_jabatan" class="col-md-4 control-label">Nama Jabatan</label>
						<div class="col-md-6">
	                        <input type="text" name="Nama_jabatan" class="form-control" value="{{ $jabatan->Nama_jabatan }}">
	                    </div>
	                </div>
	                <div class="form-group{{ $errors->has('Besaran_uang') ? ' has-error' : '' }}">
	                    <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
						<div class="col-md-6">
	                        <input type="text" id="angka3" name="Besaran_uang" class="form-control" value="{{ $jabatan->Besaran_uang }}">
	                    </div>
	                </div>
					<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a href="{{ route('jabatan-hrd.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
					{!! Form::close() !!}
	           </div>
	       </div>
@endsection

@section('scripts')
    <script src="{{url('/js/jquery.maskMoney.min.js')}}"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                $('#angka1').maskMoney();
                $('#angka2').maskMoney({prefix:'US$'});
                $('#angka3').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
                $('#angka4').maskMoney();
            });
    </script>
@endsection