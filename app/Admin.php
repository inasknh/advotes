<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'daftar_admin';
    protected $primaryKey = 'id';
    protected $fillable = ['username','role','npm', 'id_fakultas'];
    public $timestamps = true;

    public function pemilihan()
    {
    	return $this->hasMany(Pemilihan::class);
    }

    public function fakultas()
    {
    	return $this->belongsTo(Fakultas::class);
    }
}
