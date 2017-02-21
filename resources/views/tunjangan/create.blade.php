@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                   <h4 class="title">Tambah data</h4>
                   <p class="category">Tunjangan</p>
                <hr>
                </div>
                <div class="content">
                {!! Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'route' => ['tunjangan.store']]) !!}

                    <div class="form-group">
                        <label for="golongan_id" class="col-md-4 control-label">Jabatan & Golongan</label>
                        <div class="col-md-6">
                            <select name="golongan_id" id="golongan_id" class="form-control">
                                @foreach($golongans as $golongan)
                                    @if (Input::old('golongan_id') == $golongan->Jabatan->id.'|'.$golongan->Golongan->id)
                                        <option value="{{$golongan->Jabatan->id}}|{{$golongan->Golongan->id}}" selected>{{$golongan->Jabatan->Nama_jabatan}} | {{$golongan->Golongan->Nama_golongan}}</option>
                                    @else
                                        <option value="{{$golongan->Jabatan->id}}|{{$golongan->Golongan->id}}">{{$golongan->Jabatan->Nama_jabatan}} | {{$golongan->Golongan->Nama_golongan}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-md-4 control-label">Status</label>
                        <div class="col-md-6">
                            <select name="status" id="status" class="form-control">
                                    @if (Input::old('status') == 'Lajang')
                                        <option value="Lajang" selected>Lajang</option>
                                    @else
                                        <option value="Lajang">Lajang</option>
                                    @endif

                                    @if (Input::old('status') == 'Menikah')
                                        <option value="Menikah" selected>Menikah</option>
                                    @else
                                        <option value="Menikah">Menikah</option>
                                    @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_anak" class="col-md-4 control-label">Jumlah Anak</label>
                        <div class="col-md-6">
                            <input type="number" value="{{ old('jumlah_anak') }}" name="jumlah_anak" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="besaran_uang" class="col-md-4 control-label">Besaran Uang</label>
                        <div class="col-md-6">
                            <input type="text" name="besaran_uang" value="{{ old('besaran_uang') }}" id="besaran_uang" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="{{ route('tunjangan.index') }}" class="btn btn-default">Batal</a>
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
<script src="{{url('/js/jquery.maskMoney.min.js')}}"></script>

<script type="text/javascript">
    // script select2 
    $('select').select2();

    $(document).ready(function(){
        $('#angka1').maskMoney();
        $('#angka2').maskMoney({prefix:'US$'});
        $('#besaran_uang').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
        $('#angka4').maskMoney();
    });
</script>
@endsection