<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'golongans';
    protected $fillable = ['id','Kode_golongan', 'Nama_golongan', 'Besaran_uang','jabatan_id'];
    protected $visible = ['id','Kode_golongan', 'Nama_golongan', 'Besaran_uang','jabatan_id'];
    public $timestamps = true;

    public function Kategori_lembur(){
    	return $this->hasMany('App\kategori_lembur', 'golongan_id');
    }
    public function Pegawai(){
        return $this->hasMany('App\Pegawai', 'golongan_id');
    }
    public function Tunjangans(){
        return $this->hasMany('App\Tunjangans', 'golongan_id');
    }
    public function Jabatan(){
        return $this->belongsTo('App\Jabatan', 'jabatan_id');
    }
}
