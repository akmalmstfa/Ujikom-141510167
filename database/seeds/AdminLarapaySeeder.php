<?php

use Illuminate\Database\Seeder;
use App\Jabatan;
use App\Golongan;
use App\User;
use App\Pegawai;
use App\Kategori_lembur;

class AdminLarapaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hrd = User::create([
            'name'      => 'jajang',
            'email'     => 'jajang@larapay.com',
            'password'  => bcrypt('rahasia'),
            'permission'  => 'hrd',
            ]);

        $keuangan = User::create([
            'name'      => 'udin',
            'email'     => 'udin@larapay.com',
            'password'  => bcrypt('rahasia'),
            'permission'  => 'keuangan',
            ]);

        $jabatan = Jabatan::create([
        	'Kode_jabatan' => 'J001', 
        	'Nama_jabatan' => 'Admin', 
        	'Besaran_uang' => 3000000,
            ]);

        $golhrd = Golongan::create([
        	'Kode_golongan' => 'G001', 
        	'Nama_golongan' => 'HRD', 
        	'Besaran_uang' 	=> 2000000,
        	'jabatan_id' 	=> $jabatan->id,
            ]);

        $golkeuangan = Golongan::create([
        	'Kode_golongan' => 'G002', 
        	'Nama_golongan' => 'KUANGAN', 
        	'Besaran_uang' 	=> 2150000,
        	'jabatan_id' 	=> $jabatan->id,
            ]);

        Pegawai::create([
        	'Nip'			=>	'10496520001',
        	'user_id'		=>	$hrd->id, 
        	'jabatan_id'	=>  $jabatan->id, 
        	'golongan_id'	=>	$golhrd->id, 
        	'Photo'			=> 'hrd.jpg',
            ]);

        Pegawai::create([
        	'Nip'			=>	'10496520002',
        	'user_id'		=>	$keuangan->id, 
        	'jabatan_id'	=>  $jabatan->id, 
        	'golongan_id'	=>	$golkeuangan->id, 
        	'Photo'			=> 'keuangan.jpg',
            ]);

        Kategori_lembur::create([
        	'Kode_lembur'	=> 'KL001', 
        	'jabatan_id' 	=>  $jabatan->id, 
	        'golongan_id'	=>	$golhrd->id, 
	        'Besaran_uang' 	=>	100000,
            ]);


        Kategori_lembur::create([
        	'Kode_lembur'	=> 'KL002', 
        	'jabatan_id'	=>  $jabatan->id, 
	        'golongan_id' 	=>	$golkeuangan->id, 
	        'Besaran_uang'	=>	100000,
            ]);

    }
}
