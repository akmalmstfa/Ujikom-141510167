@extends('light.app')

@section('content')
		<h2>Data Pegawai</h2>
		<a href="{{ route('pegawai.create') }}" style="margin-bottom: 10px;" class="btn btn-success">Tambah Pegawai</a>
		<table class="table table-striped table-hover">
			<thead>
				<tr class="success">
					<th><center>No</center></th>
					<th>Nip</th>
					<th>Nama Pegawai</th>
					{{-- <th>Permission</th> --}}
					<th>Nama Jabatan</th>
					<th>Nama Golongan</th>
					<th>Photo</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
			?>
				@foreach($pegawai as $data)
					<tr>
						<td><center>{{ $no++ }}</center></td>
						<td>{{ $data->Nip }}</td>
						<td>{{ $data->User->name }}</td>
						{{-- <td>{{ $data->User->permission }}</td> --}}
						<td>{{ $data->Jabatan->Nama_jabatan }}</td>
						<td>{{ $data->Golongan->Nama_golongan }}</td>
						<td>
							<img src="{{asset('/image/'.$data->Photo)}}" height="50px" width="50px">
						</td>
						<td>
						@if($data->Jabatan->Nama_jabatan === 'Admin')
			                <div class='btn-group'>
			                    <a href="javascript:;" class='btn btn-default btn-sm' title="data pegawai admin tidak bisa diedit"><i class="ion-edit"></i></a>
			                    <a href="javascript:;" class='btn btn-danger btn-sm' title="data pegawai admin tidak bisa dihapus"><i class="ion-ios-trash"></i></a>
			                </div>
						@else
			                {!! Form::open(['route' => ['pegawai.destroy', $data->id], 'method' => 'delete']) !!}
			                <div class='btn-group'>
			                    <a href="{!! route('pegawai.edit', [$data->id]) !!}" class='btn btn-default btn-sm'><i class="ion-edit"></i></a>
			                    {!! Form::button('<i class="ion-ios-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Yakin ingin menghapus data ini?')"]) !!}
			                </div>
			                {!! Form::close() !!}
			            @endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
@endsection