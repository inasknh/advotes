<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilihan extends Model
{
    protected $table = 'daftar_pemilihan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_fakultas','nama','id_admin', 'tanggal_mulai', 'tanggal_selesai'];
    public $timestamps = true;

    public function admin()
    {
    	return $this->belongsTo(Admin::class);
    }

    public function dptPemilihan()
    {
        return $this->hasMany(DPTPemilihan::class);
    }

    public function kandidat()
    {
        return $this->hasMany(Kandidat::class);
    }


}
