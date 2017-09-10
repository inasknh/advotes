<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    protected $table = 'daftar_pemilih';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','npm'];
    public $timestamps = true;

    public function dptPemilihan()
    {
        return $this->hasMany(DPTPemilihan::class);
    }
}
