@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                    <h4 class="title">Tambah Golongan Jabatan</h4> 
                    <p class="category"><b>{{$jabatan->Nama_jabatan}}</b></p>
                    <hr>
                </div>
                <div class="content">
                    {!!Form::open(['route' => 'golem.store', 'class' => 'form-horizontal','method' => 'POST']) !!}
						<div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Nama Goloongan</label>
							<div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama"   required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Besaran_uang" class="col-md-4 control-label">Besaran Uang Golongan</label>
                            <div class="col-md-6">
                                <input id="angka3" type="text" class="form-control" name="Besaran_uang"  required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lembur" class="col-md-4 control-label">Besaran Uang Lembur /jam</label>
                            <div class="col-md-6">
                                <input id="lembur" type="text" class="form-control" name="lembur"  required autofocus>
                                <input type="hidden" value="{{$jabatan->id}}" name="jabatan_id">
                                <input type="hidden" value="{{$jabatan->Kode_jabatan}}" name="koja">
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
                                <a href="{{ route('golem.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
					{!! Form::close() !!}
	           </div>
	       </div>
	   </div>
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
                $('#lembur').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
                $('#angka4').maskMoney();
            });
    </script>
@endsection