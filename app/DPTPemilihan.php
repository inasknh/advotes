<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DPTPemilihan extends Model
{
    protected $table = 'daftar_dpt_pemilihan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_pemilihan', 'id_pemilih'];
    public $timestamps = true;

    public function pemilih()
    {
    	return $this->belongsTo(Pemilih::class);
    }

    public function pemilihan()
    {
    	return $this->belongsTo(Pemilihan::class);
    }
}
