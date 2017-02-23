@extends('light.app')

@section('content')
		<h2>Data Jabatan</h2>
		<a href="javascript:;" style="margin-bottom: 10px;" class="btn btn-warning">Generate PDF</a>
		<table class="table table-striped table-hover" style="font-size: 13px;">
			<thead>
				<tr class="success">
					<th>NO</th>
					<th>Lembur</th>
					<th>Uang Lembur</th>
					<th>Tunjangan</th>
					<th>Gaji Pokok</th>
					<th>Total Gaji</th>
					<th>Tanggal Gaji</th>
					<th>Action / Status Pengambilan</th>
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
						<td>{{ $gaji->Jumlah_jam_lembur }} jam</td>
						<td>{{ 'Rp. '.number_format($gaji->Jumlah_uang_lembur, 2, ",", ".") }}</td>
						<td>{{ 'Rp. '.number_format($uang_tunjangan, 2, ",", ".") }}</td>
						<td>{{ 'Rp. '.number_format($gaji->Gaji_pokok, 2, ",", ".") }}</td>
						<td>{{ 'Rp. '.number_format($gaji->Total_gaji, 2, ",", ".") }}</td>
						<td>{{ date_format($gaji->created_at, 'd M Y') }}</td>
						@if(is_null($gaji->Tanggal_pengambilan))
						<td>
								<center>
										<a href="{{url('pegawai/ambil-gaji',$gaji->id)}}" class="btn btn-info btn-sm" title="ambil"><i class="ion-android-hand"></i></a>
								</center>
						</td>
						@else
						<td>
								<center>
										<b>Sudah diambil</b>
								</center>
						</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
@endsection