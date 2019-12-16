<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pinjaman extends Model
{
    public $table = "pinjamans";
    protected $primaryKey = 'idPinjaman';
    protected $fillable = ['idNasabah', 'bunga', 'jmlPinjam', 'sisaPinjam', 'status'];

    public function nasabahs(){

        return $this->hasOne('App\nasabah', 'idNasabah', 'idNasabah');
    }

    /***
     * One to Many
     * One nasabah have Many pinjaman
     * 
    */
    public function angsurans(){

        return $this->hasMany(angsurans::class);
    }

}
