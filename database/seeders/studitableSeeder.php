<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class studitableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studi')->insert([
            [
                'studi'=>'Agama',
                'parent_id' => null,
            ]
        ]);
    }
}
