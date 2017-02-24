@extends('light.app')

@section('content')
		<h2>Data Jabatan</h2>
		@if(date('d') == '24' && count(DB::table('penggajians')->whereDate('created_at',date('Y-m-24'))->get()) == 0)
		@php
			$tunjanganpegawai = DB::table('tunjangan_pegawais')
										->select('tunjangan_pegawais.*')
										->get();
			$data = [];
			foreach ($tunjanganpegawai as $value) 
			{
				$data[] = $value->pegawai_id;		
			}		
			$pagawes = DB::table('pegawais')
						->whereNotIn('id',$data)
						->get();
			$notreg = count($pagawes);
		@endphp
			@if($notreg == 0)
			<a href="{{route('penggajian.create')}}" style="margin-bottom: 10px;" class="btn btn-danger">Generate Gaji</a>
			@else
			<button type="button" class="btn btn-danger" style="margin-bottom: 10px;"  data-toggle="modal" data-target="#AlertConfirm">Generate Gaji</button>

			<!-- Modal -->
			  <div class="modal fade" id="AlertConfirm" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h24 class="modal-title">Tunjangan</h5>
			        </div>
			        <div class="modal-body">
			        	<p>Ada pegawai yang belum memiliki tunjangan, Jika pegawai tidak memiliki tunjangan gajinya tidak akan tergenerate. mohon periksa page <a href="{{route('pegawai-tunjangan.index')}}">Tunjangan Pegawai</a></p>
			        </div>
			        <div class="modal-footer">
						<a href="{{route('penggajian.create')}}" class="btn btn-primary">Tetap Generate</a>
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
			@endif
		@else
		<a href="javascript:;"  style="margin-bottom: 10px;" class="btn btn-danger" disabled>Generate Gaji</a>
		@endif
		<a href="javascript:;" style="margin-bottom: 10px;" class="btn btn-warning">Generate PDF</a>
		<table class="table table-striped table-hover" style="font-size: 13px;">
			<thead>
				<tr class="success">
					<th>NO</th>
					<th>Nama</th>
					<th>Lembur</th>
					<th>Uang Lembur</th>
					<th>Tunjangan</th>
					<th>Gaji Pokok</th>
					<th>Total Gaji</th>
					<th>Tanggal Gaji</th>
					<th>Tanggal Pengambilan</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
			?>
				@foreach($gajih as $gaji)
					<tr>
						<td>{{ $no++ }}</td>
						@php
							$pegawai_id = $gaji->Tunjangan_Pegawai->pegawai_id;
							$pegawai 	= DB::table('pegawais')
											->join('users', 'pegawais.user_id', '=', 'users.id')
											->select('pegawais.*','users.name')
											->where('pegawais.id',$pegawai_id)
											->first();
							$tunjangan 	= DB::table('tunjangans')
											->select('tunjangans.*')
											->where('id',$gaji->Tunjangan_Pegawai->Kode_tunjangan_id)
											->first();
							if ($tunjangan->Jumlah_anak > 0) {
								$uang_tunjangan = $tunjangan->Jumlah_anak * $tunjangan->Besaran_uang;
							}else{
								$uang_tunjangan = $tunjangan->Besaran_uang;
							}
						@endphp
						<td>{{ $pegawai->name }}</td>
						<td>{{ $gaji->Jumlah_jam_lembur }} jam</td>
						<td>{{ 'Rp. '.number_format($gaji->Jumlah_uang_lembur, 2, ",", ".") }}</td>
						<td>{{ 'Rp. '.number_format($uang_tunjangan, 2, ",", ".") }}</td>
						<td>{{ 'Rp. '.number_format($gaji->Gaji_pokok, 2, ",", ".") }}</td>
						<td>{{ 'Rp. '.number_format($gaji->Total_gaji, 2, ",", ".") }}</td>
						<td>{{ date_format($gaji->created_at, 'd M Y') }}</td>
						@if(is_null($gaji->Tanggal_pengambilan))
						<td><b>Belum Diambil . . .</b></td>
						<td><b>Menunggu Diambil . . .</b></td>
						@else
							@php
								$tanggal = date_format( date_create($gaji->Tanggal_pengambilan), 'd M Y');
							@endphp
						<td>{{ $tanggal }}</td>
						<td><b>Sudah diambil</b></td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
@endsection