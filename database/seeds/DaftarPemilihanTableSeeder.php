<?php

use Illuminate\Database\Seeder;
use App\Pemilihan;

class DaftarPemilihanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pemilihan=[
        	['id_fakultas'=>1, 'nama'=>'BEM UI 2016', 'id_admin'=> 3,'tanggal_mulai'=>'2016-09-02', 'tanggal_selesai'=>'2016-09-10'],
            ['id_fakultas'=>1, 'nama'=>'DPM UI Anggota Independen 2016 Calon FF', 'id_admin'=> 4, 'tanggal_mulai'=>'2016-09-02', 'tanggal_selesai'=>'2016-09-10'],
        	['id_fakultas'=>14, 'nama'=>'BEM FEB UI 2016', 'id_admin'=> 3, 'tanggal_mulai'=>'2017-08-03', 'tanggal_selesai'=>'2017-08-10']
        ];
        Pemilihan::insert($pemilihan);

        $pemilihan=[
            ['id_fakultas'=>9, 'nama'=>'Anggota Independen BPM FIK UI 2016', 'id_admin'=> 5, 'tanggal_mulai'=>'2016-06-01', 'tanggal_selesai'=>'2016-06-10'],
            ['id_fakultas'=>4, 'nama'=>'Anggota Independen DPM Fasilkom UI 2016', 'id_admin'=> 1, 'tanggal_mulai'=>'2016-04-07', 'tanggal_selesai'=>'2016-04-10'],
            ['id_fakultas'=>4, 'nama'=>'BEM Fasilkom UI 2016', 'id_admin'=> 2, 'tanggal_mulai'=>'2016-04-07', 'tanggal_selesai'=>'2016-04-10'],
        ];
        Pemilihan::insert($pemilihan);
    }
}
