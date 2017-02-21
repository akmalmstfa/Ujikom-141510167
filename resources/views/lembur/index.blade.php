@extends('light.app')

@section('content')
<div class="card">
	<div class="header">
		<h4 class="title">Data Lembur</h4>
		<p class="category">Pegawai</p>
		<hr>
		<a href="{{ route('lemburpegawai.create') }}" class="btn btn-success">Tambah Data</a>
	</div>
	<div class="content">
		<table class="table table-striped table-hover">
			<thead>
				<tr class="success">
					<th><center>No</center></th>
					<th>Kode Lembur</th>
					<th>Nama Pegawai</th>
					<th>Jumlah Jam</th>
					<th>Tanggal Lembur</th>
					<th >Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
			?>
				@foreach($dates as $data)
					<tr>
						<td><center>{{ $no++ }}</center></td>
						<td>{{ $data->Kategori_lembur->Kode_lembur }}</td>
						@php
						$nama = DB::table('users')->where('id',$data->Pegawai->user_id)->first();
						@endphp
						<td>{{ $nama->name }}</td>
						<td>{{ $data->Jumlah_jam }}</td>
						<td>{{  date_format($data->created_at, 'j F Y') }}</td>
						<td>
							{!! Form::open(['method' => 'DELETE', 'route' => ['lemburpegawai.destroy', $data->id]]) !!}
			                <div class='btn-group'>
			                    <a href="{!! route('lemburpegawai.edit', [$data->id]) !!}" class='btn btn-default btn-sm'><i class="ion-edit"></i></a>
								{!! Form::button('<i class="ion-ios-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Yakin ingin menghapus data ini?')"]) !!}
			                <div class='btn-group'>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection