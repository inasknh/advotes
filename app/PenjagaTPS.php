<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenjagaTPS extends Model
{
    protected $table = 'daftar_penjaga_tps';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','npm', 'id_fakultas','imei'];
    public $timestamps = true;

    public function fakultas()
    {
    	return $this->belongsTo(Fakultas::class);
    }
}
