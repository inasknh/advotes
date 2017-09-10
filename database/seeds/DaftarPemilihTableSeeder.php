<?php

use Illuminate\Database\Seeder;
use App\Pemilih;

class DaftarPemilihTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftar_pemilih=[
        ['nama'=> 'Aisyah Zakiah', 'npm'=>'1406543662'],
        ['nama'=>'Siti Ina Sakinah', 'npm'=>'1406543795'],
        ['nama'=>'Fathya Afifah', 'npm'=>'1406543832'],
        ['nama'=>'Ilyyas Sukmadjarna', 'npm'=>'1406622641'],
        ['nama'=>'Wresni Ronggowerdhi', 'npm'=>'1406543896']
      ];

      Pemilih::insert($daftar_pemilih);
    }
}
