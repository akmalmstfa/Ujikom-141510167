<?php

namespace App\Http\Controllers;

use Request;
use App\Jabatan;
use App\Golongan;
use App\kategori_lembur;
use DB;
use Validator;
use Input;

class KategoriLemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $kategori_lembur = kategori_lembur::all();
        return view('kategori_lembur.index', compact('jabatan', 'golongan', 'kategori_lembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();

        $untukid = DB::table('kategori_lemburs')->max('id');
        $newkode = $untukid + 1;
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

        return view('kategori_lembur.create', compact('kode', 'jabatan', 'golongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $jabatan = Request::all();
        $jb = Validator::make($jabatan, [
                'Kode_lembur' => 'required',
                'jabatan_id' => 'required',
                'golongan_id' => 'required',
                'Besaran_uang' => 'required'
        ]);
        $jb = kategori_lembur::create([
            'Kode_lembur' => $jabatan['Kode_lembur'],
            'jabatan_id' => $jabatan['jabatan_id'],
            'golongan_id' => $jabatan['golongan_id'],
            'Besaran_uang' => $jabatan['Besaran_uang']
        ]);

        return redirect('katelembur');

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
        $kategori_lembur = kategori_lembur::find($id);
        return view('kategori_lembur.show', compact('kategori_lembur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $kategori_lembur = kategori_lembur::find($id);
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        return view('kategori_lembur.edit', compact('kategori_lembur', 'jabatan', 'golongan'));
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
        //
        $kategorilemburUpdate = Request::all();
        $kategori_lembur = kategori_lembur::find($id);
        $kategori_lembur->update($kategorilemburUpdate);

        return redirect('katelembur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        kategori_lembur::find($id)->delete();
        return redirect('katelembur');
    }
}
