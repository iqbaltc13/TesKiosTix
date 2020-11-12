<?php

namespace App\Http\Controllers\Dashboard;

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

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->route  ='dashboard.kategori.';
        $this->view  ='dashboard.kategori.';
        $this->withArraySelect   = [
            'buku'
        ];
    }
    public function index(){
        $arrReturn=[
            'sidebar'      => 'modul', 
        ];
        return view($this->view.'index',$arrReturn);
    }
    public function datatable(Request $request){
        $newObj      = new Kategori();
       
        $datas       = Kategori::with($this->withArraySelect);
            
        $datas  = $datas->orderByRaw($newObj->getTable().".created_at DESC");  
       

        return DataTables::of($datas)
       
        ->toJson();
    }
    public function edit($id, Request $request){
        $data       = Kategori::with($this->withArraySelect)
                      ->where('id',$id)->first();
        $arrReturn  = [
            'data' =>$data,
            'sidebar'      => 'modul', 
        ];
        return view($this->view.'edit',$arrReturn);
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'nama' => 'required'
        ]);
        DB::beginTransaction();
            $arrUpdate = [
                'nama' => $request->nama,
            ];
            $update = Kategori::where('id',$id)
                      ->update($arrUpdate);
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses mengedit data kategori');
    }
    public function create(Request $request){
        $arrReturn  = [
            'sidebar'      => 'modul', 
        ];
                
        return view($this->view.'create',$arrReturn);
    }
    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required'
        ]);
        DB::beginTransaction();
        $arrCreate = [
            'nama' => $request->nama,
        ];
        $create = Kategori::create($arrCreate);
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses menambah data kategori');
    }
    public function destroy(Request $request,$id){
        DB::beginTransaction();
        $deleteBuku = Buku::where('kategori_id',$id)
                      ->delete();
        $delete     = Kategori::where('id',$id)
                      ->delete();
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses menghapus data kategori');
    }
    public function destroyJson(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        DB::beginTransaction();
        $deleteBuku = Buku::where('kategori_id',$request->id)
                      ->delete();
        $delete     = Kategori::where('id',$request->id)
                      ->delete();
        DB::commit();
        return $this->success('sukses menghapus data kategori',$delete);
       
    }
    public function detail(Request $request,$id){
       
        $data       = Kategori::with($this->withArraySelect)
                      ->where('id',$id)->first();
        $arrReturn  = [
            'data' =>$data,
            'sidebar'      => 'modul', 
        ];
        return view($this->view.'detail',$arrReturn);

    }
    public function detailJson(Request $request,$id){
        $data       = Kategori::with($this->withArraySelect)
                      ->where('id',$id)->first();
        return $this->success('sukses menampilkan data kategori',$data);
    }
}
