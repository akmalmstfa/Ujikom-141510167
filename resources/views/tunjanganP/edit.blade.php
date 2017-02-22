@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                    <h4 class="title">Tambah Tunjangan Pegawai</h4>
                    <p class="category">Pegawai</p>
                </div>
                <div class="content">
                <hr>
                    {!!Form::model($pegawai,['route' => ['pegawai-tunjangan.update',$pegawai->id],'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <label for="pegawai_id" class="col-md-4 control-label">Nama Pegawai :</label>
                            <div class="col-md-6">
                              {{ $pegawai->User->name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=Jabatan" class="col-md-4 control-label">Jabatan :</label>
                            <div class="col-md-6">
                              {{ $pegawai->Jabatan->Nama_jabatan }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Golongan" class="col-md-4 control-label">Golongan :</label>
                            <div class="col-md-6">
                              {{ $pegawai->Golongan->Nama_golongan }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tunjangan" class="col-md-4 control-label">Tunjangan :</label>
                            <div class="col-md-6">
                                <select name="tunjangan" class="form-control">
                                    @foreach($tunjangans as $tunjangan)
                                        @if(Input::old('tunjangan') == $pegawai->Tunjangan_pegawai->Kode_tunjangan_id || $tunjangan->id == $pegawai->Tunjangan_pegawai->Kode_tunjangan_id)
                                        <option value="{{ $tunjangan->id }}" selected>{{ $tunjangan->Status }} | {{ $tunjangan->Jumlah_anak }} | {{ 'Rp. '.number_format($tunjangan->Besaran_uang, 2, ",", ".") }}</option>
                                        @else
                                        <option value="{{ $tunjangan->id }}">{{ $tunjangan->Status }} | {{ $tunjangan->Jumlah_anak }} | {{ 'Rp. '.number_format($tunjangan->Besaran_uang, 2, ",", ".") }}</option>
                                        @endif
                                    @endforeach
                                    @if(Input::old('tunjangan') === '0')
                                        <option value="0" selected>Status | Jumlah Anak | Besar Tunjangan</option>
                                    @else
                                        <option value="0">Status | Jumlah Anak | Besar Tunjangan</option>
                                    @endif
                                </select>
                                <input type="hidden" value="{{$pegawai->id}}" name="pegawai">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
                                <a href="{{ route('pegawai-tunjangan.index') }}" class="btn btn-default">Batal</a>
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