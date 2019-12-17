<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class angsuran extends Model
{
    protected $primaryKey = 'idAngsuran';
    protected $fillable = ['idPinjaman', 'jmlAngsuran', 'keterangan'];



    public function pinjamans(){

        return $this->hasOne('App\pinjaman', 'idPinjaman', 'idPinjaman');
    }
}
