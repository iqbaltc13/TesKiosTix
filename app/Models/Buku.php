<?php

namespace App\Models;
use App\Http\Controllers\Helpers\WebHelperController;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $appends = [
        'tanggal_input',
    ];
       
    protected $table = 'buku';
    protected $guarded = [];
    public function  penulis() {
        return $this->belongsTo('App\Models\Penulis','penulis_id','id');
    }
    public function  kategori() {
        return $this->belongsTo('App\Models\Kategori','kategori_id','id');
    }
    public function getTanggalInputAttribute(){
        $objWebHelper = new WebHelperController();
        $valDateTime =$objWebHelper->olahTanggalToBaku($this->attributes['created_at']);
        return $valDateTime;
    }
}
