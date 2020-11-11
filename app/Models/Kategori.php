<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $appends = [
    ];
       
    protected $table = 'kategori';
    protected $guarded = [];
    public function  buku() {
        return $this->hasMany('App\Models\Buku','kategori_id','id')->orderBy('created_at','desc');
    }
}
