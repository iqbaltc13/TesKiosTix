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

class BukuController extends Controller
{
    public function __construct()
    {
        $this->route  ='dashboard.buku.';
        $this->view  ='dashboard.buku.';
        $this->withArraySelect   = [
            'kategori',
            'penulis',
        ];
    }
    public function index(){
        $dataPenulis  = Penulis::with([])->get();
        $dataKategori = Kategori::with([])->get();
        $arrReturn=[
            'dataPenulis'  => $dataPenulis,
            'dataKategori' => $dataKategori,
        ];
        return view($this->view.'index',$arrReturn);
    }
    public function datatable(Request $request){
        $newObj      = new Buku();
       
        $datas       = Buku::with($this->withArraySelect);
        if($request->penulis_id){
            $datas = $datas->where('penulis_id',$request->penulis_id);
        }
        if($request->kategori_id){
            $datas = $datas->where('kategori_id',$request->kategori_id);
        }
            
        $datas  = $datas->orderByRaw($newObj->getTable().".created_at DESC");  
       

        return DataTables::of($datas)
       
        ->toJson();
    }
    public function edit($id, Request $request){
        $data       = Buku::with($this->withArraySelect)
                      ->where('id',$id)->first();
        $dataPenulis  = Penulis::with([])->get();
        $dataKategori = Kategori::with([])->get();
        
        $arrReturn  = [
            'data' =>$data,
            'dataPenulis'  => $dataPenulis,
            'dataKategori' => $dataKategori,
        ];
        return view($this->view.'edit',$arrReturn);
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'judul'       => 'required',
            'isbn'        => 'required',
            'kategori_id' => 'required',
            'penulis_id'  => 'required',
        ]);
        DB::beginTransaction();
            $arrUpdate = [
                'judul'       => $request->judul,
                'isbn'        => $request->isbn,
                'kategori_id' => $request->kategori_id,
                'penulis_id'  => $request->penulis_id,
                
            ];
            $update = Buku::where('id',$id)
                      ->update($arrUpdate);
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses mengedit data buku');
    }
    public function create(Request $request){
        $dataPenulis  = Penulis::with([])->get();
        $dataKategori = Kategori::with([])->get();
        $arrReturn=[
            'dataPenulis'  => $dataPenulis,
            'dataKategori' => $dataKategori,
        ];
                
        return view($this->view.'create',$arrReturn);
    }
    public function store(Request $request){
        $this->validate($request, [
            'judul'       => 'required',
            'isbn'        => 'required',
            'kategori_id' => 'required',
            'penulis_id'  => 'required',
        ]);
        DB::beginTransaction();
        $arrCreate = [
            'judul'       => $request->judul,
            'isbn'        => $request->isbn,
            'kategori_id' => $request->kategori_id,
            'penulis_id'  => $request->penulis_id,
        ];
        $create = Buku::create($arrCreate);
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses menambah data buku');
    }
    public function destroy(Request $request,$id){
        DB::beginTransaction();
      
        $delete     = Buku::where('id',$id)
                      ->delete();
        DB::commit();
        return redirect()->route($this->route.'index')
        ->with('success', 'Sukses menghapus data buku');
    }
    public function destroyJson(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        DB::beginTransaction();
     
        $delete     = Buku::where('id',$request->id)
                      ->delete();
        DB::commit();
        return $this->success('sukses menghapus data buku',$delete);
       
    }
    public function detail(Request $request,$id){
       
        $data       = Buku::with($this->withArraySelect)
                      ->where('id',$id)->first();
        $arrReturn  = [
            'data' =>$data,
        ];
        return view($this->view.'detail',$arrReturn);

    }
    public function detailJson(Request $request,$id){
        $data       = Buku::with($this->withArraySelect)
                      ->where('id',$id)->first();
        return $this->success('sukses menampilkan data buku',$data);
    }
}
