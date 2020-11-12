<?php

namespace App\Models;
use App\Http\Controllers\Helpers\WebHelperController;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    protected $appends = [
        'tanggal_input',
    ];
       
    protected $table = 'penulis';
    protected $guarded = [];
    public function  buku() {
        return $this->hasMany('App\Models\Buku','penulis_id','id')->orderBy('created_at','desc');
    }
    public function getTanggalInputAttribute(){
        $objWebHelper = new WebHelperController();
        $valDateTime =$objWebHelper->olahTanggalToBaku($this->attributes['created_at']);
        return $valDateTime;
    }
}
