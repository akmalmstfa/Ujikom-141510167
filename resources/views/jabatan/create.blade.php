@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                    <h4 class="title">Tambah Data</h4>
                    <p class="category">Jabatan</p>
                </div>
                <div class="content">
                    {!!Form::open(['route' => 'jabatan-hrd.store', 'class' => 'form-horizontal','method' => 'POST']) !!}
						<div class="form-group{{ $errors->has('Kode_jabatan') ? ' has-error' : '' }}">
                            <label for="Kode_jabatan" class="col-md-4 control-label">Kode Jabatan</label>
							<div class="col-md-6">
                                <input id="Kode_jabatan" type="text" class="form-control" name="Kode_jabatan" value="{{ $kode }}" readonly required autofocus>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('Nama_jabatan') ? ' has-error' : '' }}">
                            <label for="Nama_jabatan" class="col-md-4 control-label">Nama Jabatan</label>
                            <div class="col-md-6">
                                <input id="Nama_jabatan" type="text" class="form-control" name="Nama_jabatan" value="{{ old('Nama_jabatan') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Besaran_uang') ? ' has-error' : '' }}">
                            <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
                            <div class="col-md-6">
                                <input id="angka3" type="text" class="form-control" name="Besaran_uang" value="{{ old('Besaran_uang') }}" required autofocus>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
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