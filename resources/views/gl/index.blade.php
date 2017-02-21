@extends('light.app')

@section('content')
            <div class="card">
                <div class="header">
                    <h4 class="title">Setting Gaji</h4> 
                    <p class="category"><b>Golongan & Lembur</b></p>
					<hr>
				</div>
				<div class="content">
            	@foreach($jabatans as $jabatan)
		              <b>Jabatan : </b> {{$jabatan->Nama_jabatan}} <br>
		              <b>Gaji Jabatan :</b> {{ 'Rp. '.number_format($jabatan->Besaran_uang, 2, ",", ".") }}
		              <hr>
		        <table class="table table-striped table-hover">
			        <thead>
			        	<tr>
			              <th  width="3%" align="center">NO</th>
			              <th>Golongan</th>
			              <th>Gaji Golongan</th>
			              <th>Gaji Lembur /jam</th>
			              <th></th>
			            </tr>
			        </thead>
		            @php
		            $goal = count($jabatan->Golongan);
		            @endphp
		            <tbody>
			            @if($goal == 0)
				        <tr>
				          <td colspan="4" align="center"><h3><b>Golongan jabatan belum dibuat!</b></h3></td>
				        </tr>
			            @else
			            @php
			            $no = 1;
			            @endphp
			            	@foreach($jabatan->Golongan as $golongan)
				            <tr>
				            	@php
				            	$kl = DB::table('kategori_lemburs')
				            			->where('golongan_id',$golongan->id)
				            			->where('jabatan_id',$jabatan->id)
				            			->first();

				            	@endphp
				              <td align="center">{{$no++}}</td>
				              <td>{{$golongan->Nama_golongan}}</td>
				              <td>{{ 'Rp. '.number_format($golongan->Besaran_uang, 2, ",", ".") }}</td>
				              <td>{{ 'Rp. '.number_format($kl->Besaran_uang, 2, ",", ".") }}</td>
				              <td align="center">
				        		{!! Form::open(['route' => ['golem.destroy',$golongan->id], 'method' => 'delete']) !!}
				                <div class='btn-group'>
				              		<a href="{{ url('keuangan/golem/edit-golongan/'.$golongan->id.'/'.$kl->id)}}" class='btn btn-default btn-sm'><i class="ion-edit"></i></a>
				                    {!! Form::button('<i class="ion-ios-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Yakin ingin menghapus data ini?')"]) !!}
				                </div>
				                {!! Form::close() !!}
				              </td>
				            </tr>
				            @endforeach
			            @endif
			          	<tr>
				        	<td colspan="5">
				        		<a href="{{ route('addgol',$jabatan->Kode_jabatan) }}" class='btn btn-default'><i class="ion-ios-plus-outline"></i> Tambah Golongan</a>
				        	</td>
			          	</tr>
		            </tbody>
		        </table>
	            @endforeach
	            </div>
	        </div>

			<center>{{ $jabatans->links() }}</center>
@endsection