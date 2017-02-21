@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                   <h4 class="title">Edit data</h4>
                   <p class="category">Pegawai</p>
                <hr>
                </div>
                <div class="content">
                {!! Form::model($pegawai, ['class' => 'form-horizontal',  'enctype' => 'multipart/form-data', 'method' => 'PATCH', 'route' => ['pegawai.update', $pegawai->id], 'files' => true]) !!}

                    <div class="form-group{{ $errors->has('Nip') ? ' has-error' : '' }}">
                        <label for="Nip" class="col-md-4 control-label">Kode Jabatan</label>
                        <div class="col-md-6">
                            <input type="text" name="Nip" class="form-control" value="{{ $pegawai->Nip }}">
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nama Pegawai</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="{{ $pegawai->User->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                        <label for="golongan_id" class="col-md-4 control-label">Jabatan & Golongan</label>
                        <div class="col-md-6">
                            <select name="golongan_id" id="golongan_id" class="form-control">
                                @foreach($golongans as $golongan)
                                <option value="{{$golongan->Jabatan->id}}|{{$golongan->Golongan->id}}">{{$golongan->Jabatan->Nama_jabatan}} | {{$golongan->Golongan->Nama_golongan}}</option>
                                @endforeach
                                <option value="{{$golonganya->Jabatan->id}}|{{$golonganya->Golongan->id}}" selected>{{$golonganya->Jabatan->Nama_jabatan}} | {{$golonganya->Golongan->Nama_golongan}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('Photo') ? ' has-error' : '' }}">
                        <label for="Photo" class="col-md-4 control-label">Photo</label>
                            <div class="col-md-6">
                                <img  id="showgambar" src="{{asset('image/'.$pegawai->Photo)}}" width="510" height="510" class="img img-thumbnail">
                                <input id="Photo" type="file" class="form-control" name="Photo" value="{{ old('Photo') }}" autofocus>
                            </div>
                        </div>
                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a href="{{ route('pegawai.index') }}" class="btn btn-default">Batal</a>
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

    // script show foto
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#Photo").change(function () {
        readURL(this);
    });    
</script>
@endsection