<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nasabah extends Model
{
    //soft deleete
    use SoftDeletes;

    protected $guarded = ['idNasabah','created_at','upadated_at'];


}
