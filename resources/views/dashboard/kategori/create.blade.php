@extends('layouts.dashboard_modul')
@section('content')
<div class="uk-flex-center" data-uk-grid>
    <div class="uk-width-4-4@l">
        <div class="uk-card">
            <div class="uk-card-header sc-padding">
                <h2 class="uk-card-title">
                    Tambah Kategori
                </h2>
                <div class="uk-width-auto@s" style="padding-left:950px;">
                    <div id="sc-dt-buttons">
                        <div class="dt-buttons">
                            <a class="dt-button buttons-copy buttons-html5 sc-button" href="{{route('dashboard.kategori.index')}}" ><span data-uk-icon="icon: menu"></span> <span>List Kategori</span></a>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-card-body">
                <form method="POST" id="form_advanced_validation" class="form-create-kategori" action="{{route('dashboard.kategori.store')}}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                
                    @include('dashboard.kategori.form_create')
                    <div class="uk-margin-top">
                        <button type="submit" class="sc-button sc-button-primary sc-button-large">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
</script>
<script>
flatpickr(".flatpickr-input");
</script>
@endpush
@endsection