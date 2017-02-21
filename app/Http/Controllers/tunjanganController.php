<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori_lembur;
use App\Tunjangans;
use Alert;
use DB;
use Redirect;
use Input;

class tunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tunjangans = Tunjangans::with('Jabatan','Golongan')->get();
        return view('tunjangan.index',compact('tunjangans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $golongans = Kategori_lembur::with('Jabatan','Golongan')
                            ->orderBy('jabatan_id')
                            ->get(); 
        return view('tunjangan.create',compact('golongans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $format = substr($request->besaran_uang,0,2);
        if ($format === 'Rp') {
            $uang = substr($request->besaran_uang,4);
            $hasiluang = str_replace(".", "", $uang);
            $check = (int)$hasiluang;
            if ($check == 0) {
                Alert::error('Besaran uang tidak boleh diisi 0!', 'Error !');
                return redirect(route('tunjangan.create'))
                                ->withInput($request->input());
            }
        }else{
            $hasiluang = $request->besaran_uang;
        }

        $gj = $request->golongan_id;
        $result_explode = explode('|', $gj);

        $untukid = DB::table('tunjangans')->max('id');
        $newkode = $untukid + 1;
        $digit = strlen($newkode);
        if ($digit == '1') {
            $kode = "T00".$newkode;
        }
        elseif ($digit == '2') {
            $kode = "T0".$newkode;
        }
        elseif ($digit == '3') {
            $kode = "T".$newkode;
        }

        $qwerty = [
                    'jabatan_id'    => $result_explode[0],
                    'golongan_id'   => $result_explode[1],
                    'Status'        => $request['status'],
                    'Jumlah_anak'   => $request['jumlah_anak']
                ];
        $input = Tunjangans::where($qwerty)->get();
        // dd($input);
        if (count($input) > 0) {
            Alert::error('Data yang anda input sudah ada!', 'Error !')->autoclose(2900);
            return Redirect::back()->withInput(Input::all());
        }

        Tunjangans::create([
            'Kode_tunjangan' => $kode,
            'jabatan_id' => $result_explode[0],
            'golongan_id' => $result_explode[1],
            'Besaran_uang' => $hasiluang,
            'Status' => $request['status'],
            'Jumlah_anak' => $request['jumlah_anak'],
        ]);

        Alert::success('Data berhasil disimpan!', 'Saved!');
        return redirect(route('tunjangan.index'));
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
        $golongans = Kategori_lembur::with('Jabatan','Golongan')
                            ->orderBy('jabatan_id')
                            ->get(); 
        $tunjangan = Tunjangans::with('Jabatan','Golongan')
                            ->orderBy('jabatan_id')
                            ->find($id);
        return view('tunjangan.edit',compact('golongans','tunjangan'));
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
        $tunjangan = Tunjangans::find($id);
        $format = substr($request->besaran_uang,0,2);
        if ($format === 'Rp') {
            $uang = substr($request->besaran_uang,4);
            $hasiluang = str_replace(".", "", $uang);
            $check = (int)$hasiluang;
            if ($check == 0) {
                Alert::error('Besaran uang tidak boleh diisi 0!', 'Error !');
                return redirect(route('tunjangan.create'))
                                ->withInput($request->input());
            }
        }else{
            $hasiluang = $request->besaran_uang;
        }

        $gj = $request->golongan_id;
        $result_explode = explode('|', $gj);

        $untukid = DB::table('tunjangans')->max('id');
        $newkode = $untukid + 1;
        $digit = strlen($newkode);
        if ($digit == '1') {
            $kode = "T00".$newkode;
        }
        elseif ($digit == '2') {
            $kode = "T0".$newkode;
        }
        elseif ($digit == '3') {
            $kode = "T".$newkode;
        }

        $qwerty = [
                    'jabatan_id'    => $result_explode[0],
                    'golongan_id'   => $result_explode[1],
                    'Status'        => $request['status'],
                    'Jumlah_anak'   => $request['jumlah_anak']
                ];
        $input = Tunjangans::where($qwerty)
                        ->whereNotIn('id',[$tunjangan->id])
                        ->get();
        // dd($input);
        if (count($input) > 0) {
            Alert::error('Data yang anda input sudah ada!', 'Error !')->autoclose(2900);
            return Redirect::back()->withInput(Input::all());
        }

            $tunjangan->Kode_tunjangan = $kode;
            $tunjangan->jabatan_id = $result_explode[0];
            $tunjangan->golongan_id = $result_explode[1];
            $tunjangan->Besaran_uang = $hasiluang;
            $tunjangan->Status = $request['status'];
            $tunjangan->Jumlah_anak = $request['jumlah_anak'];
            $tunjangan->save();

        Alert::success('Data berhasil diubah!', 'Updated!');
        return redirect(route('tunjangan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tunjangan = Tunjangans::find($id);

        if (empty($tunjangan)) {
            Alert::error('Tunjangan Tidak ada!','Error!');

            return redirect(route('tunjangan.index'));
        }
        
        Tunjangans::find($id)->delete();

        Alert::success('Data berhasil dihapus!', 'Deleted!');
        return redirect(route('tunjangan.index'));
    }
}
