<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarDptPemilihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_dpt_pemilihan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pemilihan')->unsigned();
            $table->integer('id_pemilih')->unsigned();
            $table->timestamps();
        });

        Schema::table('daftar_dpt_pemilihan', function (Blueprint $table) {
            $table->foreign('id_pemilihan')
                ->references('id')->on('daftar_pemilihan')
                ->onDelete('cascade');
            $table->foreign('id_pemilih')
                ->references('id')->on('daftar_pemilih')
                ->onDelete('cascade');
        });

        Schema::table('daftar_dpt_pemilihan', function (Blueprint $table) {
            $table->unique(['id_pemilih', 'id_pemilihan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_dpt_pemilihan');
    }
}
