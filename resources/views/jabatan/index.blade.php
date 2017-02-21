@extends('light.app')

@section('content')
		<h2>Data Jabatan</h2>
		<a href="javascript:;" style="margin-bottom: 10px;" class="btn btn-warning">Generate PDF</a>
		@if(Auth::user()->permission == 'hrd')
		<a href="{{ route('jabatan-hrd.create') }}" style="margin-bottom: 10px;" class="btn btn-success">Tambah</a>
		@endif
		<table class="table table-striped table-hover">
			<thead>
				<tr class="success">
					<th>No</th>
					<th>Kode Jabatan</th>
					<th>Nama Jabatan</th>
					<th>Besaran Uang</th>
					@if(Auth::user()->permission == 'hrd')
					<th>Action</th>
					@endif
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
			?>
				@foreach($jabatan as $data)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $data->Kode_jabatan }}</td>
						<td>{{ $data->Nama_jabatan }}</td>
						<td>{{ 'Rp. '.number_format($data->Besaran_uang, 2, ",", ".") }}</td>
					@if(Auth::user()->permission == 'hrd')
		            <td>
		                {!! Form::open(['route' => ['jabatan-hrd.destroy', $data->id], 'method' => 'delete']) !!}
		                <div class='btn-group'>
		                    <a href="{!! route('jabatan-hrd.edit', [$data->id]) !!}" class='btn btn-default btn-xs'><i class="ion-edit"></i></a>
		                    {!! Form::button('<i class="ion-ios-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Yakin ingin menghapus data ini?')"]) !!}
		                </div>
		                {!! Form::close() !!}
		            </td>
					@endif

					</tr>
				@endforeach
			</tbody>
		</table>
@endsection