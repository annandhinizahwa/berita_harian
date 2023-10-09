@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Index Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Berita</h4>
                    <form class="form form-horizontal needs-validation" novalidate method="POST"
                        enctype="multipart/form-data" action="{{ route('berita.store') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Subjek Berita</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" class="form-control" placeholder="Subjek Berita" autofocus
                                            id="subjek" name="subjek" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Isi Berita</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <textarea id="isi" name="isi" class="form-control"  maxlength="100" rows="8" placeholder="Isi berita..."></textarea>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
@endpush
