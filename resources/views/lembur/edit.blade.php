@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                    <h4 class="title">Edit Data Lembur</h4>
                    <p class="category">Pegawai</p>
                </div>
                <div class="content">
                <hr>
                    {!!Form::open(['route' => 'lemburpegawai.store', 'class' => 'form-horizontal']) !!}
						<div class="form-group{{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
                            <label for="pegawai_id" class="col-md-4 control-label">Nama Pegawai</label>
                            <div class="col-md-6">
                                <select id="pegawai_id" type="text" class="form-control" name="pegawai_id" required autofocus>
                                    @foreach($pegawais as $pegawaiy)
                                        <option value="{{$pegawaiy->id}}">{{$pegawaiy->User->name}}</option>
                                    @endforeach
                                        <option value="{{$pegawai->id}}" selected>{{$pegawai->User->name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Jumlah_jam') ? ' has-error' : '' }}">
                            <label for="Jumlah_jam" class="col-md-4 control-label">Jumlah Jam</label>
                            <div class="col-md-6">
                                <input id="Jumlah_jam" type="number" value="{{$lembur->Jumlah_jam}}" class="form-control" min="1" max="5" name="Jumlah_jam"  required autofocus>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                                <a href="{{ route('lemburpegawai.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
					{!! Form::close() !!}
	           </div>
	       </div>
@endsection

@section('css')
    <link href="{{asset('/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('scripts')
    <script src="{{asset('/js/select2.min.js')}}"></script>
    
    <script type="text/javascript">
        // script select2 
        $('select').select2();
    </script>
@endsection