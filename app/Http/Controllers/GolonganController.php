<?php

namespace App\Http\Controllers;

use Request;
use App\Golongan;
use DB;
use Validator;
use Input;

class GolonganController extends Controller
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
        $golongan = Golongan::all();
        return view('golongan.index', compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $untukid = DB::table('golongans')->max('id');
        $newkode = $untukid + 1;
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

        

        return view('golongan.create', compact('kode'));
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
        $golongan = Request::all();
        $jb = Validator::make($golongan, [
                'Kode_golongan' => 'required',
                'Nama_golongan' => 'required|unique',
                'Besaran_uang' => 'required'
        ]);
        $jb = Golongan::create([
            'Kode_golongan' => $golongan['Kode_golongan'],
            'Nama_golongan' => $golongan['Nama_golongan'],
            'Besaran_uang' => $golongan['Besaran_uang']
        ]);

        return redirect('golongan');

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
        $golongan = Golongan::find($id);
        return view('golongan.show', compact('golongan'));
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
        $golongan = Golongan::find($id);
        return view('golongan.edit', compact('golongan', 'kode'));
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
        $golonganUpdate = Request::all();
        $golongan = Golongan::find($id);
        $golongan->update($golonganUpdate);

        return redirect('golongan');
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
        Golongan::find($id)->delete();
        return redirect('golongan');
    }
}
