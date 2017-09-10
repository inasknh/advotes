<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    protected $table = 'daftar_kandidat';
    protected $primaryKey = 'id';
    protected $fillable = ['id_pemilihan','no_urut','nama_ketua','path_foto_ketua', 'npm_ketua','nama_wakil', 'path_foto_wakil', 'npm_wakil'];
    public $timestamps = true;

    public function pemilihan()
    {
    	return $this->belongsTo(Pemilihan::class);
    }
}
