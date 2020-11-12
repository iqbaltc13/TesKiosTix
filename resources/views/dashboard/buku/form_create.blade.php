<div class="uk-card-content">
    <div class="uk-margin">
        <label class="uk-form-label" for="f-empl-recent">Judul</label>
        <input class="uk-input" id="judul" name="judul" type="text"  data-sc-input="outline" required>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="f-empl-recent">ISBN</label>
        <input class="uk-input" id="isbn" name="isbn" type="text"  data-sc-input="outline" required>
    </div>
    <div class="uk-margin">
        {{-- <label class="uk-form-label" for="kategori_id">Kategori<sup>*</sup></label> --}}
        <div class="uk-form-controls">
            <select class="uk-select" id="kategori_id"  name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($dataKategori as $kategori)
                    <option  value="{{$kategori->id}}">{{$kategori->nama}}</option>
                
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
                <option value="">-- Pilih Penulis --</option>
                @foreach ($dataPenulis as $penulis)
                    <option value="{{$penulis->id}}">{{$penulis->nama}}</option>
                
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