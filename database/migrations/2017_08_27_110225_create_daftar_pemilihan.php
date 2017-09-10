<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarPemilihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_pemilihan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_fakultas')->unsigned();
            $table->string('nama');
            $table->integer('id_admin')->unsigned()->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('daftar_pemilihan', function (Blueprint $table) {
            $table->foreign('id_admin')
                ->references('id')->on('daftar_admin')->onDelete('cascade');
            $table->unique(['id', 'id_admin', 'id_fakultas']);
        });

        Schema::table('daftar_pemilihan', function (Blueprint $table) {
            $table->foreign('id_fakultas')
                ->references('id')->on('daftar_fakultas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_pemilihan');
    }
}
