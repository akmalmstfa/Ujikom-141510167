@extends('light.app')

@section('content')
		<h2>Data Golongan</h2>
		<a href="{{ route('golongan.create') }}" style="margin-bottom: 10px;" class="btn btn-warning">Generate PDF</a>
		<table class="table table-striped table-hover">
			<thead>
				<tr class="success">
					<th><center>No</center></th>
					<th>Kode Golongan</th>
					<th>Nama Golongan</th>
					<th>Besaran Uang</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
			?>
				@foreach($golongan as $data)
					<tr>
						<td><center>{{ $no++ }}</center></td>
						<td>{{ $data->Kode_golongan }}</td>
						<td>{{ $data->Nama_golongan }}</td>
						<td><?php echo 'Rp. '.number_format($data->Besaran_uang, 2, ",", "."); ?></td>
					</tr>
				@endforeach
			</tbody>
		</table>
@endsection