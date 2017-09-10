<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(DaftarFakultasTableSeeder::class);
        $this->call(DaftarAdminTableSeeder::class);
        $this->call(DaftarPemilihTableSeeder::class);
        $this->call(DaftarPemilihanTableSeeder::class);
        $this->call(DaftarKandidatTableSeeder::class);
        $this->call(DaftarDPTPemilihanTableSeeder::class);
        $this->call(DaftarPenjagaTPSTableSeeder::class); 
    }
}
