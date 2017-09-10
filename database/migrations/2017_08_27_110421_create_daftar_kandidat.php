<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarKandidat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_kandidat', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_pemilihan')->unsigned();
            $table->integer('no_urut');
            $table->string('nama_ketua');
            $table->string('path_foto_ketua');
            $table->char('npm_ketua', 10);
            $table->string('nama_wakil')->nullable();
            $table->string('path_foto_wakil')->nullable();
            $table->char('npm_wakil', 10)->nullable();

        });

        Schema::table('daftar_kandidat', function (Blueprint $table) {
            $table->foreign('id_pemilihan')
                ->references('id')->on('daftar_pemilihan')
                ->onDelete('cascade');
        });

        Schema::table('daftar_kandidat', function (Blueprint $table) {
            $table->unique(['id_pemilihan', 'no_urut']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_kandidat');
    }
}
