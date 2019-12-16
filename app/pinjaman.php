<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pinjaman extends Model
{
    public $table = "pinjamans";
    protected $primaryKey = 'idPinjaman';
    protected $fillable = ['idNasabah', 'bunga', 'jmlPinjam'];

    /***
     * One to Many
     * One nasabah have Many pinjaman
     * 
    */
    public function angsurans(){

        return $this->hasMany(angsurans::class);
    }

}
