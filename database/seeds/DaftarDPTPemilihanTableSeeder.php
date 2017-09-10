<?php

use Illuminate\Database\Seeder;
use App\DPTPemilihan;

class DaftarDPTPemilihanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $daftar_dpt_pemilihan=[
        ['id_pemilih' => 1, 'id_pemilihan'=> 1],
        ['id_pemilih' => 1, 'id_pemilihan'=> 2],

        ['id_pemilih' => 2, 'id_pemilihan'=> 1],
        ['id_pemilih' => 2, 'id_pemilihan'=> 3],
        
        ['id_pemilih' => 3, 'id_pemilihan'=> 1],
        ['id_pemilih' => 3, 'id_pemilihan'=> 4],
        
        ['id_pemilih' => 4, 'id_pemilihan'=> 1],
        ['id_pemilih' => 4, 'id_pemilihan'=> 5],
        ['id_pemilih' => 4, 'id_pemilihan'=> 6],
        
        ['id_pemilih' => 5, 'id_pemilihan'=> 1],
        ['id_pemilih' => 5, 'id_pemilihan'=> 5],
        ['id_pemilih' => 5, 'id_pemilihan'=> 6]
      ];

      DPTPemilihan::insert($daftar_dpt_pemilihan);
    }
    
}
