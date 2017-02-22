<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Lembur_pegawai;
use App\Kategori_lembur;
use App\Pegawai;
use App\Jabatan;
use App\Golongan;
use App\Tunjangan_pegawai;
use App\Tunjangans;
use App\User;

class penggajianController extends Controller
{

    public function index()
    {
        return view('penggajian.index');
    }

    public function create()
    {
        
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
