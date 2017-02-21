@extends('light.app')

@section('content')
		<h2>Data Kategori Lembur</h2>
		<a href="{{ route('katelembur.create') }}" style="margin-bottom: 10px;" class="btn btn-warning">Generate PDF</a>
		<table class="table table-striped table-hover">
			<thead>
				<tr class="success">
					<th><center>No</center></th>
					<th>Kode Lembur</th>
					<th>Nama Jabatan</th>
					<th>Nama Golongan</th>
					<th>Besaran Uang</th>
					{{-- <th>Action</th> --}}
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
			?>
				@foreach($kategori_lembur as $data)
					<tr>
						<td><center>{{ $no++ }}</center></td>
						<td>{{ $data->Kode_lembur }}</td>
						<td>{{ $data->jabatan->Nama_jabatan }}</td>
						<td>{{ $data->golongan->Nama_golongan }}</td>
						<td><?php echo 'Rp. '.number_format($data->Besaran_uang, 2, ",", "."); ?></td>
			            {{-- <td>
			                {!! Form::open(['route' => ['katelembur.destroy', $data->id], 'method' => 'delete']) !!}
			                <div class='btn-group'>
			                    <a href="{!! route('katelembur.edit', [$data->id]) !!}" class='btn btn-default btn-xs'><i class="ion-edit"></i></a>
			                    {!! Form::button('<i class="ion-ios-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Yakin ingin menghapus data ini?')"]) !!}
			                </div>
			                {!! Form::close() !!}
			            </td> --}}
					</tr>
				@endforeach
			</tbody>
		</table>
@endsection