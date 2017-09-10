w<?php

use Illuminate\Database\Seeder;
use App\Admin;

class DaftarAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftar_admin = [
            ['username'=>'siti.ina','role'=>'admin pemilihan', 'npm'=>'1406543795','id_fakultas'=>'4'],
            ['username'=>'fathya.afifah41','role'=>'superuser', 'npm'=>'1406543832','id_fakultas'=>'4'],
            ['username'=>'wresni.ronggowerdhi','role'=>'superuser', 'npm'=>'1406543896','id_fakultas'=>'4'],
            ['username'=>'gemastik.fakultas','role'=>'admin fakultas', 'npm'=>'1029384756','id_fakultas'=>'8'],
            ['username'=>'gemastik.pemilihan','role'=>'admin pemilihan', 'npm'=>'0192837465','id_fakultas'=>'8']
         ];

         Admin::insert($daftar_admin);
    }
}
