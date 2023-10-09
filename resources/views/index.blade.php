@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Index Berita</a></li>
            {{-- <li class="breadcrumb-item active" aria-current="page">Sebelum Bencana</li> --}}
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('berita.create') }}" class="btn btn-primary">Tambah Data</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subjek Berita</th>
                                    <th>Isi Berita</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($beritas as $berita)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $berita->subjek }}</td>
                                            <td>{{ $berita->isi }}</td>
                                            <td>
                                                <a class="btn icon btn-sm btn-success"
                                                    href="{{ route('berita.show', $berita->id) }}" title="Detail berita">
                                                    <i data-feather="eye"></i>
                                                </a>
                                                <a class="btn icon btn-sm btn-warning"
                                                    href="{{ route('berita.edit', $berita->id) }}" title="Edit berita">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn icon btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')" title="Hapus berita">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
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
