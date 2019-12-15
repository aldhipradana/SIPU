<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nasabah extends Model
{
    protected $primaryKey = 'idNasabah';
    protected $fillable = ['firstname', 'lastname', 'email', 'phone', 'alamat', 'photo'];

}
