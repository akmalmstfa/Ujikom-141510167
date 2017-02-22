@extends('light.app')

@section('content')
		<h2>Data Tunjangan Pegawai</h2>
		<table class="table table-striped table-hover">
			<thead>
				<tr class="success">
					<th><center>No</center></th>
					<th>Nip</th>
					<th>Nama Pegawai</th>
					<th>Nama Jabatan</th>
					<th>Nama Golongan</th>
					<th>Tunjangan</th>
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
						<td>{{ $data->Jabatan->Nama_jabatan }}</td>
						<td>{{ $data->Golongan->Nama_golongan }}</td>
						<td>
							@if(empty($data->Tunjangan_pegawai))

  							<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><i class="ion-ios-eye-outline"></i></button>

							<!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
							    <div class="modal-dialog">
							    
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h5 class="modal-title">Tunjangan</h5>
							        </div>
							        <div class="modal-body">
							          <p class="text text-danger">Tunjangan belum disi!</p>
							        </div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							        </div>
							      </div>
							      
							    </div>
							  </div>

							@else
								@php
								$value = DB::table('tunjangans')->where('id',$data->Tunjangan_pegawai->Kode_tunjangan_id)->first();
								@endphp
		  							<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal{{$data->id}}"><i class="ion-ios-eye-outline"></i></button>

									<!-- Modal -->
									  <div class="modal fade" id="myModal{{$data->id}}" role="dialog">
									    <div class="modal-dialog">
									    
									      <!-- Modal content-->
									      <div class="modal-content">
									        <div class="modal-header">
									          <button type="button" class="close" data-dismiss="modal">&times;</button>
									          <h5 class="modal-title">Tunjangan</h5>
									        </div>
									        <div class="modal-body">
									          <p>Status 		: {{$value->Status}}</p>
									          <p>Jumlah Anak 	: {{$value->Jumlah_anak}}</p>
									          <p>Besaran uang 	: {{ 'Rp. '.number_format($value->Besaran_uang, 2, ",", ".") }}</p>
									        </div>
									        <div class="modal-footer">
									          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									        </div>
									      </div>
									      
									    </div>
									  </div>
							 @endif
						</td>
						<td>
							<img src="{{asset('/image/'.$data->Photo)}}" height="50px" width="50px">
						</td>
						<td>
			                {!! Form::open(['route' => ['pegawai-tunjangan.destroy', $data->id], 'method' => 'delete']) !!}
			                <div class='btn-group'>
								@if(empty($data->Tunjangan_pegawai))
			                    <a href="{!! route('create-tunjangan', [$data->id]) !!}" title="tambah tunjangan" class='btn btn-warning btn-xs'><i class="ion-edit"></i></a>
								@else
			                    <a href="{!! route('pegawai-tunjangan.edit', [$data->id]) !!}" title="edit tunjangan" class='btn btn-default btn-xs'><i class="ion-edit"></i></a>
			                    {!! Form::button('<i class="ion-ios-trash"></i>', ['title'=>'hapus tunjangan','type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Yakin ingin menghapus data ini?')"]) !!}
			                    @endif
			                </div>
			                {!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
@endsection
@section('css')

@endsection
@section('scripts')

@endsection