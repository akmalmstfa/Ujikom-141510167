@extends('light.app')

@section('content')
		<h2>Data Jabatan</h2>
		<a href="{{route('penggajian.create')}}" style="margin-bottom: 10px;" class="btn btn-danger">Generate Gaji</a>
		<a href="javascript:;" style="margin-bottom: 10px;" class="btn btn-warning">Generate PDF</a>
		<table class="table table-striped table-hover">
			<thead>
				<tr class="success">
					<th>No</th>
					<th>Nama Pegawai</th>
					<th>Jumlah Jam Lembur</th>
					<th>Jumlah Uang Lembur</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
			?>
				{{-- @foreach($jabatan as $data)
					<tr>
						<td>{{ $no++ }}</td>
					</tr>
				@endforeach --}}
			</tbody>
		</table>
@endsection