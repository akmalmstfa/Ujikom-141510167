<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' 		=> 'admin',
        	'email'		=> 'test@example.com',
            'password'  => bcrypt('rahasia'),
            'permission'  => 'admin',
        	]);
        
        User::create([
            'name'      => 'hrd',
            'email'     => 'hrd@example.com',
            'password'  => bcrypt('rahasia'),
            'permission'  => 'hrd',
            ]);

        User::create([
            'name'      => 'keuangan',
            'email'     => 'keuangan@example.com',
            'password'  => bcrypt('rahasia'),
            'permission'  => 'keuangan',
            ]);
    }
}
