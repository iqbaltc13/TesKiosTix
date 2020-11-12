<div class="uk-card-content">
    <div class="uk-margin">
        <label class="uk-form-label" for="f-empl-recent">Judul</label>
        <input class="uk-input" id="judul" name="judul" type="text" value="{{$data->judul}}" data-sc-input="outline" required>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="f-empl-recent">ISBN</label>
        <input class="uk-input" id="isbn" name="isbn" type="text" value="{{$data->isbn}}" data-sc-input="outline" required>
    </div>
    <div class="uk-margin">
        {{-- <label class="uk-form-label" for="kategori_id">Kategori<sup>*</sup></label> --}}
        <div class="uk-form-controls">
            <select class="uk-select" id="kategori_id"  name="kategori_id" required>
                <option @if(is_null($data->kategori_id)) selected @endif value="">-- Pilih Kategori --</option>
                @foreach ($dataKategori as $kategori)
                    <option @if($data->kategori_id == $kategori->id) selected @endif value="{{$kategori->id}}">{{$kategori->nama}}</option>
                
                @endforeach
            
            </select>
        </div>
        @error('kategori_id')
           
            <div class="uk-alert-danger" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                    {{ $message }}
            </div>
        @enderror
    </div>
    <div class="uk-margin">
        {{-- <label class="uk-form-label" for="penulis_id">Penulis<sup>*</sup></label> --}}
        <div class="uk-form-controls">
            <select class="uk-select" id="penulis_id"  name="penulis_id" required>
                <option @if(is_null($data->penulis_id)) selected @endif value="">-- Pilih Penulis --</option>
                @foreach ($dataPenulis as $penulis)
                    <option @if($data->penulis_id == $penulis->id) selected @endif value="{{$penulis->id}}">{{$penulis->nama}}</option>
                
                @endforeach
            
            </select>
        </div>
        @error('penulis_id')
           
            <div class="uk-alert-danger" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                    {{ $message }}
            </div>
        @enderror
    </div>
    
</div>