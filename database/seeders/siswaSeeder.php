<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Str;  
use Illuminate\Support\Facades\Hash; 

class siswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            [
                'name'=>'Super Admin',
                'email' => 'bpk@gmail.com',
                'nis' => '0010',
                'password'=>Hash::make('12345678'),
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ]
        ]);
    }
}
