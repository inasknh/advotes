<?php

use Illuminate\Database\Seeder;
use App\Fakultas;

class DaftarFakultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $daftar_fakultas=[
          ['name' => 'UI'],
          ['name' => 'Matematika dan Ilmu Pengetahuan Alam'],
          ['name' => 'Teknik'],
          ['name' => 'Ilmu Komputer'],
          ['name' => 'Kedokteran'],
          ['name' => 'Kedokteran Gigi'],
          ['name' => 'Kesehatan Masyarakat'],
          ['name' => 'Farmasi'],
          ['name' => 'Ilmu Keperawatan'],
          ['name' => 'Ilmu Pengetahuan Budaya'],
          ['name' => 'Ilmu Sosial dan Politik'],
          ['name' => 'Psikologi'],
          ['name' => 'Hukum'],
          ['name' => 'Ekonomi dan Bisnis'],
          ['name' => 'Ilmu Administrasi'],
          ['name' => 'Vokasi']
        ];

        Fakultas::insert($daftar_fakultas);
    }
}
