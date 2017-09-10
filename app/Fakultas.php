<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'daftar_fakultas';
    protected $primaryKey = 'id';
    protected $fillable = ['nama'];
    public $timestamps = true;

    public function admin()
    {
    	return $this->hasMany(Admin::class);
    }
}
