<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nasabah extends Model
{
    protected $primaryKey = 'idNasabah';
    protected $fillable = ['firstname', 'lastname', 'email', 'phone', 'alamat', 'photo'];

    /***
     * One to Many
     * One nasabah have Many pinjaman
     * 
     */
    public function pinjamans(){

        return $this->hasMany(pinjamans::class);
    }

}
