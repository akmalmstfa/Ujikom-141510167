@extends('light.app')

@section('content')
                    {!!Form::open(['route' => 'pegawai.store', 'class' => 'form-horizontal', 'files' => true]) !!}
                        {{ csrf_field() }}   
                        <div class="col-md-6">
            <div class="card">
                <div class="header">
                   <h4 class="title">Authenticate</h4>
                <hr>
                </div>
                <div class="content">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>  
                </div>
                        </div> 
                        <div class="col-md-6">
            <div class="card">
                <div class="header">
                   <h4 class="title">Bio & Jabatan</h4>
                <hr>
                </div>
                <div class="content">   
                        <div class="form-group{{ $errors->has('Nip') ? ' has-error' : '' }}">
                            <label for="Nip" class="col-md-4 control-label">NIP</label>
                            <div class="col-md-6">
                                <input id="Nip" type="text" class="form-control" name="Nip" value="{{ $kode }}" readonly required autofocus>
                            </div>
                        </div>
                    

                        <div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            <label for="jabatan_id" class="col-md-4 control-label">Nama Jabatan</label>
                            <div class="col-md-6">
                                <select name="jabatan_id" id="jabatan_id" class="form-control select2"  required>
                                        <option value="">Pilih Jabatan</option>
                                    @foreach($jabatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->Nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            <label for="golongan_id" class="col-md-4 control-label">Nama Golongan</label>
                            <div class="col-md-6">
                                <select name="golongan_id" id="golongan_id" class="form-control select2" required>
                                        <option value="">Pilih Golongan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Photo') ? ' has-error' : '' }}">
                            <label for="Photo" class="col-md-4 control-label">Photo</label>
                            <div class="col-md-6">
                            <img  id="showgambar" src="{{asset('image/default.jpg')}}" width="510" height="510" class="img img-thumbnail">
                                <input id="Photo" type="file" class="form-control" name="Photo" value="{{ old('Photo') }}" autofocus>
                            </div>
                        </div>
                            <input id="permission" type="hidden" class="form-control" name="permission" value="pegawai" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
                                <a href="{{ route('pegawai.index') }}" class="btn btn-default">Batal</a>
                            </div>
                        </div>
                </div>
					{!! Form::close() !!}
@endsection

@section('css')
<link href="{{asset('/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('scripts')
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    // Scirpt dropdown
    $('#jabatan_id').change(function()
    {
        $.get('/api/jabatan/' + this.value + '/golongan.json', function(cities)
        {
            var $golongan = $('#golongan_id');

            $golongan.find('option').remove().end();

            $.each(cities, function(index, golongan) {
                $golongan.append('<option value="' + golongan.id  + '">' + golongan.Nama_golongan + '</option>');
            });
        });
    });

    $(document).ready(function() {
        $(".jabatan_id option[value='0']").attr("disabled","disabled");
        $(".golongan_id option[value='0']").attr("disabled","disabled");
    });

    // script selec2 
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