<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use DB;
use Validator;
use Input;
use Alert;

class JabatanController extends Controller
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
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $untukid = DB::table('jabatans')->max('id');
        $newkode = $untukid + 1;
        $digit = strlen($newkode);
        if ($digit == '1') {
            $kode = "J00".$newkode;
        }
        elseif ($digit == '2') {
            $kode = "J0".$newkode;
        }
        elseif ($digit == '3') {
            $kode = "J".$newkode;
        }

        

        return view('jabatan.create', compact('kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $uang = substr($request->Besaran_uang,4);
        $hasiluang = str_replace(".", "", $uang);
        $check = (int)$hasiluang;
        if ($check == 0) {
            Alert::error('Besaran uang tidak boleh diisi 0!', 'Error !');
            return redirect(route('jabatan.create'))
                            ->withInput($request->input());
        }
        $jabatan = $request->all();
        $jb = Validator::make($jabatan, [
                'Kode_jabatan' => 'required',
                'Nama_jabatan' => 'required|unique',
                'Besaran_uang' => 'required'
        ]);
        $jb = Jabatan::create([
            'Kode_jabatan' => $jabatan['Kode_jabatan'],
            'Nama_jabatan' => $jabatan['Nama_jabatan'],
            'Besaran_uang' => $hasiluang
        ]);

        Alert::success('Data berhasil disimpan!', 'Saved!');
        return redirect(route('jabatan.index'));

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
        $jabatan = Jabatan::find($id);
        return view('jabatan.show', compact('jabatan'));
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
        $jabatan = Jabatan::find($id);
        return view('jabatan.edit', compact('jabatan', 'kode'));
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
        $uang = substr($request->Besaran_uang,4);
        $hasiluang = str_replace(".", "", $uang);
        $request['Besaran_uang'] = $hasiluang;
        $jabatanUpdate = $request->all();
        $jabatan = Jabatan::find($id);
        $jabatan->update($jabatanUpdate);

        Alert::success('Data berhasil diubah!', 'Updated!');
        return redirect(route('jabatan-hrd.index'));
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
        $pegawai = Jabatan::find($id);

        if (empty($pegawai)) {
            Alert::error('Pegawai Tidak ada!','Error!');

            return redirect(route('jabatan-hrd.index'));
        }
        
        Jabatan::find($id)->delete();

        Alert::success('Data berhasil dihapus!', 'Deleted!');
        return redirect(route('jabatan-hrd.index'));
    }
}
