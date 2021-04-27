<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function pesanan_detail (){
        return $this->hasMany('App\Models\Pesanandetail','pesanan_id','id');
    }

}
