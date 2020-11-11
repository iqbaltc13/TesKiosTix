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

class PenulisController extends Controller
{
    public function __construct()
    {
        $this->route  ='dashboard.penulis.';
        $this->view  ='dashboard.penulis.';
        $this->withArraySelect   = [
            'buku'
        ];
    }
    public function index(){
        $arrReturn=[];
        return view($this->view.'index',$arrReturn);
    }
    public function datatable(Request $request){
        $newObj      = new Penulis();
       
        $datas       = Penulis::with($this->withArraySelect);
            
        $datas  = $datas->orderByRaw($newObj->getTable().".created_at DESC");  
       

        return DataTables::of($datas)
       
        ->toJson();
    }
    public function edit($id, Request $request){
        $data       = Penulis::with($this->withArraySelect)
                      ->where('id',$id)->first();
        $dataKategori = Kategori::with([])->get();
        $dataPenulis  = Penulis::with([])->get();
        $arrReturn  = [
            'data' =>$data,
            'dataKategori' => $dataKategori,
            'dataPenulis'  => $dataPenulis,
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
            $update = Penulis::where('id',$id)
                      ->update($arrUpdate);
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses mengedit data penulis');
    }
    public function create(Request $request){
        $dataKategori = Kategori::with([])->get();
        $dataPenulis  = Penulis::with([])->get();
        $arrReturn  = [
            'dataKategori' => $dataKategori,
            'dataPenulis'  => $dataPenulis,
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
        $create = Penulis::create($arrCreate);
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses menambah data penulis');
    }
    public function destroy(Request $request,$id){
        DB::beginTransaction();
        $deleteBuku = Buku::where('penulis_id',$id)
                      ->delete();
        $delete     = Penulis::where('id',$id)
                      ->delete();
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses menghapus data penulis');
    }
    public function destroyJson(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        DB::beginTransaction();
        $deleteBuku = Buku::where('penulis_id',$request->id)
                      ->delete();
        $delete     = Penulis::where('id',$request->id)
                      ->delete();
        DB::commit();
        return $this->success('sukses menghapus data penulis',$delete);
       
    }
    public function detail(Request $request,$id){
       
        $data       = Penulis::with($this->withArraySelect)
                      ->where('id',$id)->first();
        $arrReturn  = [
            'data' =>$data,
        ];
        return view($this->view.'detail',$arrReturn);

    }
    public function detailJson(Request $request,$id){
        $data       = Penulis::with($this->withArraySelect)
                      ->where('id',$id)->first();
        return $this->success('sukses menampilkan data penulis',$data);
    }
}
