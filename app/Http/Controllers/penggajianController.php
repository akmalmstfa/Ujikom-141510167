<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Lembur_pegawai;
use App\Kategori_lembur;
use App\Jabatan;
use App\Golongan;
use App\Tunjangan_pegawai;
use App\Tunjangans;
use App\User;
use App\Penggajian;
use Auth;
use Alert;

class penggajianController extends Controller
{

    public function index()
    {
        $gajih = Penggajian::with('Tunjangan_pegawai')->orderBy('created_at','DESC')->get();
        return view('penggajian.index',compact('gajih'));
    }

    public function create()
    {
        if (date('d') == '24' && count(Penggajian::whereDate('created_at',date('Y-m-24'))->get()) == 0) {
            $pegawai = Pegawai::with('Jabatan','Golongan','Tunjangan_pegawai')->get();

            $now = date('Y-m-d');
            $lastmonth = date('Y-m-d',strtotime('-1 month', strtotime($now)));
            foreach ($pegawai as $value) {
                $lemburs = Lembur_pegawai::where('pegawai_id',$value->id)
                                        ->whereDate('created_at','>=',$lastmonth)
                                        ->whereDate('created_at','<',$now)
                                        ->get();
                $jumlah_jam = 0;
                foreach ($lemburs as $isi) {
                    $jumlah_jam = $jumlah_jam + $isi->Jumlah_jam;
                }

                $kalem = Kategori_lembur::where('jabatan_id',$value->jabatan_id)
                                        ->where('golongan_id',$value->golongan_id)
                                        ->first();
                $jumlah_uang_lembur = $jumlah_jam * $kalem->Besaran_uang;

                $gaji_pokok = $value->Golongan->Besaran_uang + $value->Jabatan->Besaran_uang; 
                if (empty($value->Tunjangan_pegawai)) {

                }else{
                $tunjangan = Tunjangans::find($value->Tunjangan_pegawai->Kode_tunjangan_id);

                if ($tunjangan->Jumlah_anak == 0) {
                    $total_gaji = $gaji_pokok + $jumlah_uang_lembur +  $tunjangan->Besaran_uang;
                }else{
                    $total_gaji = $gaji_pokok + $jumlah_uang_lembur + ($tunjangan->Jumlah_anak * $tunjangan->Besaran_uang);
                }
                Penggajian::create([
                    'tunjangan_pegawai_id'  => $value->Tunjangan_pegawai->id, 
                    'Jumlah_jam_lembur'     => $jumlah_jam, 
                    'Jumlah_uang_lembur'    => $jumlah_uang_lembur, 
                    'Gaji_pokok'            => $gaji_pokok, 
                    'Total_gaji'            => $total_gaji, 
                    'Petugas_penerima'      => Auth::user()->name,
                    'Status_pengambilan'    => 0,
                ]);

                }
            }
            Alert::success('Gaji berhasil di generate','Generated!');
            return redirect(route('penggajian.index'));
        }else{
            Alert::error('Mohon maaf generate gaji hanya bisa tanggal 24 saja','Error!')->autoclose(2900);
            return redirect(route('penggajian.index'));
        }
    }

    public function gaji()
    {
        $pegawai = Tunjangan_pegawai::where('pegawai_id',Auth::user()->Pegawai->id)->first();
        $gajih = Penggajian::with('Tunjangan_pegawai')->where('tunjangan_pegawai_id', $pegawai->id)->get();
        return view('pegawai.gaji',compact('gajih'));
    }


    public function ambil($id)
    {
        $gaji = Penggajian::find($id);

        if (empty($gaji)) {
            Alert::error('Gaji tidak ada!','Error!')->autoclose(2900);
            return redirect(route('gaji'));
        }

        $gaji->Tanggal_pengambilan = date('Y-m-d H:i:s');
        $gaji->Status_pengambilan = 1;
        $gaji->save();
        return redirect(route('gaji'));
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
