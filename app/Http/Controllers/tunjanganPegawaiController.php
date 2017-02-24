<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tunjangans;
use App\Pegawai;
use App\Jabatan;
use App\Golongan;
use App\Tunjangan_pegawai;
use Alert; 

class tunjanganPegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('Jabatan','Golongan','User','Tunjangan_pegawai')->get();
        // dd($pegawai);   
        return view('tunjanganP.index', compact('pegawai'));
    }

    public function createtunjangan($id)
    {
        $pegawai    = Pegawai::with('Jabatan','Golongan','User')->find($id);
        $tunjangans  = Tunjangans::where('jabatan_id',$pegawai->Jabatan->id)
                                ->where('golongan_id',$pegawai->Golongan->id)
                                ->get();
        if (count($tunjangans) == 0) {
            Alert::error('Tunjangan untuk Jabatan & Golongan '.$pegawai->User->name.' belum tersedia','Error!')->autoclose(2900);
            return redirect(route('pegawai-tunjangan.index'));
        }
        return view('tunjanganP.create', compact('pegawai','tunjangans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (empty($request['tunjangan'])) {
            Alert::error('Pilih tunjangan!!','Error!');
            return redirect()->back();
        }

        Tunjangan_pegawai::create([
            'Kode_tunjangan_id' => $request['tunjangan'],
            'pegawai_id' => $request['pegawai'],
        ]);

        Alert::success('Data berhasil disimpan','Saved!');
        return redirect(route('pegawai-tunjangan.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pegawai    = Pegawai::with('Jabatan','Golongan','User','Tunjangan_pegawai')->find($id);
        $tunjangans  = Tunjangans::where('jabatan_id',$pegawai->Jabatan->id)
                                ->where('golongan_id',$pegawai->Golongan->id)
                                ->get();
        if (empty($tunjangans)) {
            Alert::error('Data tunjangan tidak ada','Error!');
            return redirect(route('pegawai-tunjangan.index'));
        }
        return view('tunjanganP.edit', compact('pegawai','tunjangans'));
    }

    public function update(Request $request, $id)
    {
        $pegawai    = Pegawai::with('Jabatan','Golongan','User','Tunjangan_pegawai')->find($id);

        if (empty($pegawai)) {
            Alert::error('Pegawai tidak ada','Error!');
            return redirect(route('pegawai-tunjangan.index'));
        }
        if (empty($pegawai->Tunjangan_pegawai)) {
            Alert::error('Tunjangan tidak ada','Error!');
            return redirect(route('pegawai-tunjangan.index'));
        }

        $tunjangan = Tunjangan_pegawai::find($pegawai->Tunjangan_pegawai->id);
        if ($request['tunjangan'] === '0') {
            Alert::error('Pilih tunjangan!!','Error!');
            return redirect()->back()
                            ->withInput($request->input());
        }

        if (empty($tunjangan)) {
            Alert::error('Tunjangan tidak ada','Error!');
            return redirect(route('pegawai-tunjangan.index'));
        }

        $tunjangan->Kode_tunjangan_id = $request['tunjangan'];
        $tunjangan->save();

        Alert::success('Data berhasil diperbarui','Updated!');
        return redirect(route('pegawai-tunjangan.index'));
    }

    public function destroy($id)
    {
        $pegawai    = Pegawai::with('Tunjangan_pegawai')->find($id);

        if (empty($pegawai)) {
            Alert::error('Pegawai tidak ada','Error!');
            return redirect(route('pegawai-tunjangan.index'));
        }
        if (empty($pegawai->Tunjangan_pegawai)) {
            Alert::error('Tunjangan tidak ada','Error!');
            return redirect(route('pegawai-tunjangan.index'));
        }

        Tunjangan_pegawai::find($pegawai->Tunjangan_pegawai->id)->delete();

        Alert::success('Tunjangan berhasil dihapus','Deleted!');
        return redirect(route('pegawai-tunjangan.index'));
    }
}
