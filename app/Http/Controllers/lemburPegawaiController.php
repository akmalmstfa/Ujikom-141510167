<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lembur_pegawai;
use App\Kategori_lembur;
use App\Pegawai;
use DB;
use Jenssegers\Date\Date;
use Alert;

class lemburPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $date = date('Y-m-d');
        // dd(date('Y-m-d',strtotime('-1 month -1 days', strtotime($date))));
        $dates = Lembur_pegawai::with('Kategori_lembur','Pegawai')
                                ->orderBy('created_at','DESC')
                                ->get();

        return view('lembur.index',compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $untukid = DB::table('lembur_pegawais')->max('id');
        $newkode = $untukid + 1;
        $digit = strlen($newkode);
        if ($digit == '1') {
            $kode = "LP00".$newkode;
        }
        elseif ($digit == '2') {
            $kode = "LP0".$newkode;
        }
        elseif ($digit == '3') {
            $kode = "LP".$newkode;
        }
        $lemburs    = Lembur_pegawai::whereDate('created_at',date('Y-m-d'))->get();

            $data= [];
        foreach ($lemburs as &$value) {
            $data[]=$value->pegawai_id;
        }
        $pegawais   = Pegawai::with('User')->whereNotIn('id',$data)->get();
        if (empty(count($pegawais))) {
            Alert::error('Semua pegawai sudah lembur hari ini','Error!')->autoclose(2900);
            return redirect(route('lemburpegawai.index'));
        }
        return view('lembur.create',compact('pegawais','kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $pegawai = Pegawai::where('id',$input['pegawai_id'])->first();
        $kl = Kategori_lembur::where('jabatan_id',$pegawai->jabatan_id)
              ->orWhere('golongan_id',$pegawai->golongan_id)->first();
        Lembur_pegawai::create([
            'Kode_lembur_id' => $kl->id,
            'pegawai_id' => $input['pegawai_id'],
            'Jumlah_jam' => $input['Jumlah_jam'],
        ]);

        Alert::success('Data berhasil disimpan','Saved!');
        return redirect(route('lemburpegawai.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd(date('Y-m-d'));
        $lembur     = Lembur_pegawai::find($id);
        $lemburs    = Lembur_pegawai::whereDate('created_at',date('Y-m-d'))->get();
        $data = [];
        foreach ($lemburs as &$value) {
            $data[]=$value->pegawai_id;
        }
        $pegawais   = Pegawai::with('User')->whereNotIn('id',$data)->get();
        $pegawai    = Pegawai::with('User')->where('id',$lembur->pegawai_id)->first();

        return view('lembur.edit',compact('pegawai','pegawais','lembur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lembur = Lembur_pegawai::find($id);
        $lembur->Jumlah_jam = $request['Jumlah_jam'];
        $lembur->save();
        
        Alert::success('Data berhasil diperbarui','Updated!');
        return redirect(route('lemburpegawai.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lembur = Lembur_pegawai::find($id);

        if (empty($lembur)) {
            Alert::error('Data sudah tidak ada','Error!');
            return redirect(route('lemburpegawai.index'));
        }
        $lembur->delete();
        return redirect(route('lemburpegawai.index'));

    }

}
