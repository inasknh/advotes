<?php

use Illuminate\Database\Seeder;
use App\Kandidat;

class DaftarKandidatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftar_kandidat=[
        	['id_pemilihan'=>1, 'no_urut'=>1, 'nama_ketua'=>'Arya Adiansyah', 'path_foto_ketua'=>'a.jpg', 'npm_ketua' => '1206271681' ,'nama_wakil'=>'Moch Abdul Majid', 'path_foto_wakil'=>'b.jpg','npm_wakil'=>'1206249542'],
            ['id_pemilihan'=>3, 'no_urut'=>1, 'nama_ketua'=>'Mulya Syafnur', 'path_foto_ketua'=>'e.jpg','npm_ketua' => '1306401965','nama_wakil'=>'Ajar Taru Seta', 'path_foto_wakil'=>'b.jpg','npm_wakil'=>'1306378792'],
            ['id_pemilihan'=>3, 'no_urut'=>2, 'nama_ketua'=>'Irsyan Maududy', 'path_foto_ketua'=>'e.jpg','npm_ketua' => '1306452000','nama_wakil'=>'Alfi Rahmadian', 'path_foto_wakil'=>'b.jpg','npm_wakil'=>'1306386144'],
            ['id_pemilihan'=>6, 'no_urut'=>1, 'nama_ketua'=>'Muhammad Gibran', 'path_foto_ketua'=>'e.jpg','npm_ketua' => '1306382045','nama_wakil'=>'Hasandi Patriawan', 'path_foto_wakil'=>'b.jpg','npm_wakil'=>'1306464474']         	
        ];

        Kandidat::insert($daftar_kandidat);

        $daftar_kandidat2=[

            ['id_pemilihan'=>4, 'no_urut'=>1, 'nama_ketua'=>'Rini Rinelly', 'path_foto_ketua'=>'h.jpg','npm_ketua' => '1306377940'],
            ['id_pemilihan'=>4, 'no_urut'=>2, 'nama_ketua'=>'Nahdah Salimah', 'path_foto_ketua'=>'h.jpg','npm_ketua' => '1406544431'],
            ['id_pemilihan'=>4, 'no_urut'=>3, 'nama_ketua'=>'Firly Andini', 'path_foto_ketua'=>'h.jpg','npm_ketua' => '1506729821'],
            ['id_pemilihan'=>4, 'no_urut'=>4, 'nama_ketua'=>'Roma Radiah', 'path_foto_ketua'=>'h.jpg','npm_ketua' => '1306464612'],
            ['id_pemilihan'=>2, 'no_urut'=>1, 'nama_ketua'=>'M Wildan Shalli R', 'path_foto_ketua'=>'c.jpg','npm_ketua' => '1206245191'],
            ['id_pemilihan'=>2, 'no_urut'=>2, 'nama_ketua'=>'Dimas Agus Putera Hardijanto', 'path_foto_ketua'=>'f.jpg', 'npm_ketua' => '1306479873'],
            ['id_pemilihan'=>5, 'no_urut'=>1, 'nama_ketua'=>'Muhammad Prakash Divy Isdarwanto', 'path_foto_ketua'=>'f.jpg', 'npm_ketua' => '1306409513']

        ];

        Kandidat::insert($daftar_kandidat2);
    }
}
