<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use stdClass;
use DateTime;
use DateInterval;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Validator;
use DB;
use DataTables;
use App\User;
use App\Http\Controllers\Helpers\WebHelperController;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penulis;

class BukuController extends Controller
{
    public function __construct()
    {
        
        $this->withArraySelect   = [
            'kategori',
            'penulis',
        ];
    }
    public function index(Request $request){
        $newObj      = new Buku();
       
        $datas       = Buku::with($this->withArraySelect);
        if($request->nama_penulis){
            $penulis = Penulis::where('nama',$request->nama_penulis)->first();
            if($penulis){
                $datas = $datas->where('penulis_id',$penulis->id);
            }
        }
        if($request->kategori){
            $kategori = Kategori::where('nama',$request->kategori)->first();
            if($kategori){
                $datas = $datas->where('kategori_id',$kategori->id);
            }
        }
        if($request->penulis_id){
            $datas = $datas->where('penulis_id',$request->penulis_id);
        }
        if($request->kategori_id){
            $datas = $datas->where('kategori_id',$request->kategori_id);    
        }
            
        $datas  = $datas->orderByRaw($newObj->getTable().".created_at DESC");
        $datas  = $datas->get();  
       

        return $this->success('sukses menampilkan data buku',$datas);
    }

}
