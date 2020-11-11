<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    protected $appends = [
    ];
       
    protected $table = 'penulis';
    protected $guarded = [];
    public function  buku() {
        return $this->hasMany('App\Models\Buku','penulis_id','id')->orderBy('created_at','desc');
    }
}
