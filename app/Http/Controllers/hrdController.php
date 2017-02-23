<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use App\Golongan;
use App\Kategori_lembur;
use Alert;
use DB;

class hrdController extends Controller
{
    
    public function index()
    {
        $jabatans = Jabatan::with('Kategori_lembur','Golongan')->paginate(2);
        return view('gl.index',compact('jabatans'));
    }

    public function addgol($kode)
    {
        $jabatan = Jabatan::where('Kode_jabatan',$kode)->first();
        return view('gl.addgol',compact('jabatan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (empty($request['nama'])) {
            Alert::error('Nama golongan harus diisi!','Error!');
            return redirect(route('addgol',$request['koja']))
                            ->withInput($request->input());
        } elseif(empty($request['Besaran_uang'])) {
            Alert::error('Besaran uang golongan harus diisi!','Error!');
            return redirect(route('addgol',$request['koja']))
                            ->withInput($request->input());
        } elseif(empty($request['lembur'])) {
            Alert::error('Besaran uang golongan harus diisi!','Error!');
            return redirect(route('addgol',$request['koja']))
                            ->withInput($request->input());
        }

        $maxid = DB::table('golongans')->max('id');
        $newkode = $maxid + 1;
        $digit = strlen($newkode);
        if ($digit == '1') {
            $kode = "G00".$newkode;
        }
        elseif ($digit == '2') {
            $kode = "G0".$newkode;
        }
        elseif ($digit == '3') {
            $kode = "G".$newkode;
        }

        $uang = substr($request->Besaran_uang,4);
        $hasiluang = str_replace(".", "", $uang);
        $check = (int)$hasiluang;
        if ($check == 0) {
            Alert::error('Besaran uang tidak boleh diisi 0!', 'Error !');
            return redirect(route('addgol',$request['koja']))
                            ->withInput($request->input());
        }

        $golongan = Golongan::create([
            'Kode_golongan' => $kode,
            'Nama_golongan' => $request['nama'],
            'Besaran_uang' => $hasiluang,
            'jabatan_id' => $request['jabatan_id'],
        ]);

        $maxid = DB::table('kategori_lemburs')->max('id');
        $newkode = $maxid + 1;
        $digit = strlen($newkode);
        if ($digit == '1') {
            $kode = "KL00".$newkode;
        }
        elseif ($digit == '2') {
            $kode = "KL0".$newkode;
        }
        elseif ($digit == '3') {
            $kode = "KL".$newkode;
        }

        $uang2 = substr($request->lembur,4);
        $hasiluang2 = str_replace(".", "", $uang2);
        $check = (int)$hasiluang2;
        if ($check == 0) {
            Alert::error('Besaran uang lembur tidak boleh diisi 0!', 'Error !');
            return redirect(route('addgol',$request['koja']))
                            ->withInput($request->input());
        }
        $kalem = kategori_lembur::create([
            'Kode_lembur' => $kode,
            'jabatan_id' => $request['jabatan_id'],
            'golongan_id' => $golongan->id,
            'Besaran_uang' => $hasiluang2
        ]);

        Alert::success('Data berhasil disimpan!', 'Saved!');
        return redirect(route('golem.index'));
    }

    
    public function show($id)
    {
        //
    }

    public function golemedit($idg,$idkl)
    {
        $golongan = Golongan::find($idg);

        if (empty($golongan)) {
            Alert::error('Golongan Tidak ada!','Error!');

            return redirect(route('golem.index'));
        }

        $kl = Kategori_lembur::find($idkl);

        if (empty($kl)) {
            Alert::error('Golongan Tidak ada!','Error!');

            return redirect(route('golem.index'));
        }

        $jabatan = Jabatan::find($golongan->jabatan_id);
        return view('gl.edit',compact('golongan','kl','jabatan'));
    }

    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        $golongan = Golongan::find($id);

        if (empty($golongan)) {
            Alert::error('Golongan Tidak ada!','Error!');

            return redirect(route('golem.index'));
        }

        $kl = Kategori_lembur::find($request->kl_id);

        if (empty($kl)) {
            Alert::error('Golongan Tidak ada!','Error!');

            return redirect(route('golem.index'));
        }

        $format = substr($request->Besaran_uang,0,2);
        if ($format === 'Rp') {
            $uang = substr($request->Besaran_uang,4);
            $hasiluang = str_replace(".", "", $uang);
        }else{
            $hasiluang = $request->Besaran_uang;
        }
        $check = (int)$hasiluang;
        if ($check == 0) {
            Alert::error('Besaran uang tidak boleh diisi 0!', 'Error !');
            return redirect(url('keuangan/golem/edit-golongan/'.$golongan->id.'/'.$kl->id))
                            ->withInput($request->input());
        }

        $golongan->update([
                'Nama_golongan' =>$request['nama'], 
                'Besaran_uang' =>$hasiluang,
            ]);

        $format = substr($request->lembur,0,2);
        if ($format === 'Rp') {
            $uang2 = substr($request->lembur,4);
            $hasiluang2 = str_replace(".", "", $uang2);
        }else{
            $hasiluang2 = $request->lembur;
        }
        $check = (int)$hasiluang2;
        if ($check == 0) {
            Alert::error('Besaran uang lembur tidak boleh diisi 0!', 'Error !');
            return redirect(url('golem/edit-golongan/'.$golongan->id.'/'.$kl->id))
                            ->withInput($request->input());
        }
        
        $kl->update([
                'Besaran_uang' =>$hasiluang2,
            ]);

        Alert::success('Data berhasil disimpan!','Saved!');
        return redirect(route('golem.index'));
    }

    public function destroy($id)
    {
        $golongan = Golongan::find($id);

        if (empty($golongan)) {
            Alert::error('Golongan Tidak ada!','Error!');

            return redirect(route('golem.index'));
        }

        $golongan = Golongan::find($id)->delete();

        Alert::success('Data berhasil dihapus','Deleted!');
        return redirect(route('golem.index'));
    }
}
