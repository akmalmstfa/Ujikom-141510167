<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use App\Golongan;
use App\User;
use App\Pegawai;
use App\Tunjangans;
use App\Tunjangan_pegawai;
use App\Kategori_lembur;
use DB;
use Validator;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use File;
use Alert;
class PegawaiController extends Controller
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
        $pegawai = Pegawai::with('Jabatan','Golongan')->get();
        return view('pegawai.index', compact('jabatan', 'golongan', 'pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $untukid = DB::table('pegawais')->max('id');
        $newkode = $untukid + 1;
        $digit = strlen($newkode);
        if ($digit == '1') {
            $kode = "1049652000".$newkode;
        }
        elseif ($digit == '2') {
            $kode = "104965200".$newkode;
        }
        elseif ($digit == '3') {
            $kode = "10496520".$newkode;
        }
        elseif ($digit == '4') {
            $kode = "1049652".$newkode;
        }

        $dd = User::all();
        $jabatan = Jabatan::with('Golongan')->get();
        $golongan = Golongan::all();
        return view('pegawai.create', compact('kode', 'pegawai', 'dd', 'jabatan', 'golongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
         $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|confirmed',
            'permission' => 'required',
            'jabatan_id' => 'required',
            'golongan_id' => 'required',
                ]);
        if ($validator->fails()) {
            return redirect(route('pegawai.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->all();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'permission' => $input['permission']
        ]);

           $mm = new Pegawai;
           $mm->Nip = Input::get('Nip'); 
           $mm->user_id = $user->id;  
           $mm->jabatan_id = Input::get('jabatan_id'); 
           $mm->golongan_id = Input::get('golongan_id'); 

        if($request->hasFile('Photo')){
            $file = $request->file('Photo');
            $destinationPath = public_path().'/image/';
            $extention = $file->getClientOriginalName();
            $filename = str_random(6).'_'. $extention;
            $uploadSuccess = $file->move($destinationPath, $filename);
            $mm->Photo = $filename;
        }
            $mm->save();

        Alert::success('Data berhasil disimpan!', 'Saved!');
        return redirect(route('pegawai.index'));
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
        $pegawai = Pegawai::find($id);
        return view('pegawai.show', compact('pegawai'));
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
        $pegawai = pegawai::find($id);

        $golonganya = Kategori_lembur::whereIn('jabatan_id',[$pegawai->jabatan_id])
                            ->whereIn('golongan_id',[$pegawai->golongan_id])
                            ->with('Jabatan','Golongan')
                            ->orderBy('jabatan_id')
                            ->first(); 
        $golongans = Kategori_lembur::whereNotIn('id',[$golonganya->id])
                            ->with('Jabatan','Golongan')
                            ->orderBy('jabatan_id')
                            ->get();  

        return view('pegawai.edit', compact('pegawai', 'jabatan', 'golongans','alljabatan','golonganya'));
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
        $gj = $request->golongan_id;
        $result_explode = explode('|', $gj);
        Validator::make($request->all(), [
            'Nip' => 'unique:pegawais,nip',
        ]);

        $pegawai = Pegawai::find($id);
        $pegawai->Nip = $request->get('Nip'); 
        $pegawai->jabatan_id = $result_explode[0]; 
        $pegawai->golongan_id = $result_explode[1]; 

        if(Input::hasFile('Photo')){
            $old_cover = $pegawai->Photo;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . $old_cover;

            try{
                if ($old_cover === 'default.jpg') {

                }else{
                File::delete($filepath);
                }
            } catch (FileNotFoundException $e){

            }



            $file = $request->file('Photo');
            $destinationPath = public_path().'/image/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $pegawai->Photo = $filename;
        }
        $tunjangan = Tunjangans::where('jabatan_id',$result_explode[0])
                                ->where('golongan_id',$result_explode[1])
                                ->first();
        if (!empty($tunjangan)) {
                $tunjanganP = Tunjangan_pegawai::find($pegawai->id);
                if (!empty($tunjanganP)) {
                    $tunjanganP->Kode_tunjangan_id = $tunjangan->id;
                    $tunjanganP->save();
                }
        }
        
        $pegawai->save();


        Alert::success('Data berhasil diperbarui!', 'Updated!');
        return redirect(route('pegawai.index'));
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
        $pegawai = Pegawai::find($id);

        if (empty($pegawai)) {
            Alert::error('Pegawai Tidak ada!','Error!');

            return redirect(route('pegawai.index'));
        }


        $old_cover = $pegawai->Photo;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . $old_cover;

        try{
            if ($old_cover === 'default.jpg') {

            }else{
                File::delete($filepath);
            }
        } catch (FileNotFoundException $e){

        }

        Pegawai::find($id)->delete();

        Alert::success('Data berhasil dihapus!', 'Deleted!');
        return redirect(route('pegawai.index'));
    }
}
