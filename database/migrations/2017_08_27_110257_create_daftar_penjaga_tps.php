<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarPenjagaTps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_penjaga_tps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->char('npm', 10);
            $table->integer('id_fakultas')->unsigned();
            $table->String('imei');
            $table->timestamps();
        });

        Schema::table('daftar_penjaga_tps', function (Blueprint $table) {
            $table->foreign('id_fakultas')
                ->references('id')->on('daftar_fakultas')->onDelete('cascade');
        });

        Schema::table('daftar_penjaga_tps', function (Blueprint $table) {
            $table->unique('npm');
        });

        Schema::table('daftar_penjaga_tps', function (Blueprint $table) {
            $table->unique('imei');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_penjaga_tps');
    }
}
