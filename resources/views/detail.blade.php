@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    {{-- <script type="module" src="{{ asset('assets/js/berita.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/plugin/relativeTime.js"></script>


@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Index Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Berita</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Berita</h4>
                    <form class="form form-horizontal needs-validation" novalidate method="POST"
                        enctype="multipart/form-data" action="{{ route('berita.update', $berita->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Waktu Berita</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p id="waktu-berita"></p> 
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Subjek Berita</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" class="form-control" placeholder="Subjek Berita" autofocus
                                            id="subjek" name="subjek" value="{{ old('subjek', $berita->subjek) }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Isi Berita</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <textarea id="isi" name="isi" class="form-control" maxlength="100" rows="8" placeholder="Isi berita..."
                                            disabled>{{ old('isi', $berita->isi) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>

@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            dayjs.extend(dayjs_plugin_relativeTime);
            
            var waktuBerita = "{{ $berita->created_at }}"; 
            var waktuBeritaObj = dayjs(waktuBerita);
            var waktuSaatIni = dayjs(); 
    
            var perbedaanDetik = waktuSaatIni.diff(waktuBeritaObj, 'second');
            var waktuFormatted;
    
            if (perbedaanDetik < 60) {
                // detik jika perbedaan kurang dari 1 menit
                waktuFormatted = perbedaanDetik + ' detik yang lalu';
            } else if (perbedaanDetik < 3600) {
                // menit jika perbedaan kurang dari 1 jam
                var perbedaanMenit = Math.floor(perbedaanDetik / 60);
                waktuFormatted = perbedaanMenit + ' menit yang lalu';
            } else if (perbedaanDetik < 86400) {
                // jam jika perbedaan kurang dari 1 hari
                var perbedaanJam = Math.floor(perbedaanDetik / 3600);
                waktuFormatted = perbedaanJam + ' jam yang lalu';
            } else {
                // hari jika perbedaan lebih dari 1 hari
                var perbedaanHari = Math.floor(perbedaanDetik / 86400);
                waktuFormatted = perbedaanHari + ' hari yang lalu';
            }
    
            document.getElementById('waktu-berita').textContent = waktuFormatted;
        });
    </script>
      
@endpush
