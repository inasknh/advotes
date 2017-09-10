<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_fakultas')->unsigned();
            $table->string('username');
            $table->text('role');
            $table->char('npm', 10);
            $table->timestamps();
        });

        Schema::table('daftar_admin', function (Blueprint $table) {
            $table->foreign('id_fakultas')
                ->references('id')->on('daftar_fakultas')->onDelete('cascade');
        });

        Schema::table('daftar_admin', function (Blueprint $table) {
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
        // DB::statement('drop table admins cascade');
        Schema::dropIfExists('daftar_admin');
    }
}
