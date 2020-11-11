@extends('layouts.dashboard_modul')
@section('content')
<div class="uk-card uk-margin" id="vue_component">
    <div class="uk-card-body">
        <div class="uk-child-width-1-2@m" >
            
            <select name="select-penulis" id="pilih-penulis" style="padding-left:10px;" class="uk-select" onchange="selectPenulis()"  >
                <option value="">Semua Penulis</option>
                @foreach ($dataPenulis as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option> 
                @endforeach
            </select>
            <select name="select-kategori" id="pilih-kategori"  class="uk-select"  onchange="selectKategori()" style="display:none;">
                <option value="">Semua Kategori</option>
                @foreach($dataKategori as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option> 
                @endforeach
            </select>
           
             
           
        </div>
    </div>
</div>
<div class="uk-card uk-margin" >
    <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
        <div class="uk-flex-1 uk-first-column">
            <h3 class="uk-card-title">&nbsp;&nbsp;&nbsp;List Buku</h3>
        </div>
        <div class="uk-width-auto@s">
            <div id="sc-dt-buttons">
                <div class="dt-buttons">
                    <a class="dt-button buttons-copy buttons-html5 sc-button" href="{{route('dashboard.buku.create')}}" ><span data-uk-icon="icon: plus"></span> <span>Add Buku</span></a>
                    <button class="dt-button buttons-csv buttons-html5 sc-button" tabindex="0" aria-controls="sc-dt-buttons-table" type="button"><span>CSV </span></button>
                    <button class="dt-button buttons-excel buttons-html5 sc-button" tabindex="0" aria-controls="sc-dt-buttons-table" type="button"><span>Excel </span></button>
                  
                </div>
            </div>
        </div>
        <div class="uk-width-auto@s">
            <div id="sc-dt-buttons"></div>
        </div>
    </div>
    <hr class="uk-margin-remove">
    <div class="uk-card-body">
        <table id="sc-dt-buttons-table" class="uk-table uk-table-striped dt-responsive datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>ISBN</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               
                
            </tbody>                
        </table>
        <div id="modal-detail" data-uk-modal>
            <div class="uk-modal-dialog">
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Detail Buku</h2>
                </div>
                <div class="uk-modal-body detail-buku">
                    <table id="detail-buku-table" class="uk-table uk-table-striped dt-responsive">
                        <tbody>
                            {{-- 
                            <tr>
                                <td></td>
                                <td></td>
                            </tr> 
                            --}}
                            <tr>
                                <td>Judul</td>
                                <td class="judul"></td>
                            </tr>
                            <tr>
                                <td>ISBN</td>
                                <td class="isbn"></td>
                            </tr>
                            <tr>
                                <td>Penulis</td>
                                <td class="penulis"></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td class="kategori"></td>
                            </tr>
                            
                            <tr>
                                <td>Tanggal Input</td>
                                <td class="tanggal_input"></td>
                            </tr>  
                                       
                        </tbody>                
                    </table>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    
                    <a href="#" class="sc-button sc-button-secondary uk-modal-close" >Close</a>
                </div>
            </div>
        </div>
        <div id="confirm-delete" data-uk-modal>
            <div class="uk-modal-dialog">
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Confirm Delete Buku</h2>
                </div>
                <div class="uk-modal-body delete-buku">
                   <p>Are you sure delete this data ?</p>
                   <form method="POST" id="delete-form" action="" accept-charset="UTF-8">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" id="input-hidden-csrf-token" value="">
                   </form>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <a class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" href="#" >No</a>
                    <a href="#" @click="delete"  class="sc-button sc-button-secondary uk-modal-close" >Yes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script>
     let refresh = setInterval(function () { 
       
        
        let arrParse = []; 
       
        datatableWithParse(arrParse);
        
        alertSuccess('Sukses memuat data');
    }, 60000);
    function alertSuccess(message) {
        
        let alert = '<div class="uk-alert-success uk-alert" data-uk-alert="">'+
                        '<a class="uk-alert-close uk-icon uk-close" data-uk-close="">'+
                            '<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">'+
                                '<line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>'+
                                '<line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>'+
                            '</svg>'+
                        '</a>'+message+					
                    '</div>';
                    
        document.querySelector('#alert-elements').innerHTML=alert;
        //$('#alert-elements').append(alert);
    }
    function selectPenulis(){
        value = document.getElementById('pilih-penulis').value;
                   
        let arrParse= [];
        if(value){
            arrParse['penulis_id'] = value;
        }
        
        datatableWithParse(arrParse);
        
    }
    function selectKategori(){
        value = document.getElementById('pilih-kategori').value;
        
        let arrParse= [];
        if(value){
            arrParse['kategori_id'] = value;
           
        }
        
        datatableWithParse(arrParse);
       
    }
    function datatableWithParse(arrParse){
        var url = "{{route('dashboard.buku.datatable')}}";
        url = url + '?';

       

        for (var key in arrParse) {
            if (arrParse.hasOwnProperty(key)){
                url=url+key+'='+arrParse[key]+'&&';
                
            }
               
        }
        //$('.datatable tbody').empty();
       
        let table =$('.datatable').DataTable().ajax.url(url).load();

        return table;
        
    }
    function modalDetail(id){
        let linkDetail = "{{route('dashboard.buku.detail-json', ':id')}}";
            linkDetail = linkDetail.replace(':id', id);
            axios.get(linkDetail, {
               
            })
            .then(function (response) {
                //console.log(response.data.data);
                viewDetail(response.data.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function viewDetail(data) {
        if(data){
            document.querySelector('#modal-detail .judul').innerHTML = data.judul ? data.judul   : '';
            document.querySelector('#modal-detail .isbn').innerHTML = data.isbn ? data.isbn   : '';
            document.querySelector('#modal-detail .penulis').innerHTML = data.penulis ? data.penulis.nama   : '';
            document.querySelector('#modal-detail .kategori').innerHTML = data.kategori ? data.kategori.nama   : '';
            document.querySelector('#modal-detail .tanggal_input').innerHTML = data.tanggal_input ? data.tanggal_input   : '';
            
        } 
    }

    function modalDelete(id){
        let linkDelete = "{{route('dashboard.buku.destroy', ':id')}}";
            linkDelete = linkDelete.replace(':id', id);
        document.getElementById('delete-form').action = linkDelete;
        let csrfToken= document.querySelector("meta[name='csrf-token']").getAttribute("content");
        document.getElementById('input-hidden-csrf-token').value=csrfToken;
    }

    function datatable(){
        var url = "{{route('dashboard.buku.datatable')}}";
        var table = $('.datatable').DataTable({
            // ordering: false,
            "columnDefs": [
                            { "orderable": false, "targets": 4 },
                            
                            {
                                    "targets": '_all',        
                            },
                        ],
            "order": [[ 0, "desc" ]],
            "processing": true,
            "ajax": url,
            "columns": [
                    { 
                        data: 'judul',
                    },
                    { 
                        data: 'isbn',
                    },
                    { 
                        
                        data: null,
                        searchable:true,
                        render: function(data){
                            if(data.penulis){
                                namaPenulis = data.penulis ? data.penulis.nama : '---';
                                
                            }
                            else{
                                namaPenulis = '-';
                            }
                            return namaPenulis;
                        }
                    },
                    { 
                        
                        data: null,
                        searchable:true,
                        render: function(data){
                            if(data.kategori){
                                namaKategori = data.kategori ? data.kategori.nama : '---';
                                
                            }
                            else{
                                namaKategori = '-';
                            }
                            return namaKategori;
                        }
                    },
                    
                    {
                        data: null,
                        searchable: false,
                        render: function(data){
                            let linkEdit = "{{route('dashboard.buku.edit', ':id')}}";
                                linkEdit = linkEdit.replace(':id', data.id);
                            let aksi='';
                            aksi +=    '<div><a class="sc-button sc-button-success sc-js-button-wave-light" onclick="modalDetail('+data.id+')" href="#modal-detail" data-uk-toggle><span data-uk-icon="icon: file-text"></span>Detail</a></div>'+
                                       '<div><a class="sc-button sc-button-primary sc-js-button-wave-light" href="'+linkEdit+'"><span data-uk-icon="icon: pencil"></span></span> Edit</a></div>'+
                                       '<div><a class="sc-button sc-button-danger sc-js-button-wave-light" @click="delete('+data.id+')" onclick="modalDelete('+data.id+')" href="#confirm-delete" data-uk-toggle><span data-uk-icon="icon: trash"></span>Hapus</a></div>';
                            return aksi;
                        }
                    },
                ]
        });

        return table;
    }
</script>

<script>
    new Vue({
            el: '#vue_component',
            data:{
               
            },
            watch:{
               
            },
            methods:{
                detail:function(id){
                      console.log('detail data'+ id);
                },
                delete:function(){
                    document.getElementById("delete-form").submit();
                    document.getElementById('delete-form').action = null;
                    document.getElementById('input-hidden-csrf-token').value=null;
                },

                
            },
            computed:{
               
            },
            mounted() {
                datatable(); 
            
            },
        });

</script>

@endpush
@endsection