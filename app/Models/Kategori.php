<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Helpers\WebHelperController;
use DateTime;

class Kategori extends Model
{
    protected $appends = [
        'tanggal_input',
    ];
       
    protected $table = 'kategori';
    protected $guarded = [];
    public function  buku() {
        return $this->hasMany('App\Models\Buku','kategori_id','id')->orderBy('created_at','desc');
    }
    public function getTanggalInputAttribute(){
        $objWebHelper = new WebHelperController();
        $valDateTime =$objWebHelper->olahTanggalToBaku($this->attributes['created_at']);
        return $valDateTime;
    }
}
