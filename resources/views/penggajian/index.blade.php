@extends('light.app')

@section('content')
		<h2>Data Jabatan</h2>
		@if(date('d') == '5' && count(DB::table('penggajians')->whereDate('created_at',date('Y-m-5'))->get()) == 0)
		<a href="{{route('penggajian.create')}}" style="margin-bottom: 10px;" class="btn btn-danger">Generate Gaji</a>
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