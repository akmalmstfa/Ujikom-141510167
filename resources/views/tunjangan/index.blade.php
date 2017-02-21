@extends('light.app')

@section('content')
<div class="card">
	<div class="header">
		<h4 class="title">Data Lembur</h4>
		<p class="category">Pegawai</p>
		<hr>
		<a href="{{ route('tunjangan.create') }}" class="btn btn-success">Tambah Data</a>
	</div>
	<div class="content">
		<table class="table table-striped table-hover">
			<thead class="success">
				<tr class="success">
					<th><center>No</center></th>
					<th>Jabatan</th>
					<th>Golongan</th>
					<th>Status</th>
					<th>Jumlah Anak</th>
					<th>Besaran uang</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@php
				$no = 1;
			@endphp	
			@foreach($tunjangans as $tunjangan)
				<tr>
					<td><center>{{ $no++ }}</center></td>
					<td>{{$tunjangan->Jabatan->Nama_jabatan}}</td>
					<td>{{$tunjangan->Golongan->Nama_golongan}}</td>
					<td>{{$tunjangan->Status}}</td>
					<td>{{$tunjangan->Jumlah_anak}}</td>
					<td>{{ 'Rp. '.number_format($tunjangan->Besaran_uang, 2, ",", ".") }}</td>
					<td>
			        	{!! Form::open(['route' => ['tunjangan.destroy', $tunjangan->id], 'method' => 'delete']) !!}
			        	<div class='btn-group'>
			        	    <a href="{!! route('tunjangan.edit', [$tunjangan->id]) !!}" class='btn btn-default btn-sm'><i class="ion-edit"></i></a>
			        	    {!! Form::button('<i class="ion-ios-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Yakin ingin menghapus data ini?')"]) !!}
			        	</div>
			        	{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection