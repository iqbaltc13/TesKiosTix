<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $appends = [
    ];
       
    protected $table = 'buku';
    protected $guarded = [];
    public function  penulis() {
        return $this->belongsTo('App\Models\Penulis','penulis_id','id');
    }
    public function  kategori() {
        return $this->belongsTo('App\Models\Kategori','kategori_id','id');
    }
}
