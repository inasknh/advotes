<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarPemilih extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_pemilih', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->char('npm', 10);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('daftar_pemilih', function (Blueprint $table) {
            $table->unique('npm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_pemilih');
    }
}
