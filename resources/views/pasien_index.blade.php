@extends('layout.app_modern', ['title' => 'Data Pasien'])

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3 class="text-white mb-0">
                                <i class="ti ti-users me-2"></i>Data Pasien
                            </h3>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <a href="{{ route('pasien.create') }}" class="btn btn-light">
                                <i class="ti ti-plus me-2"></i>Tambah Pasien
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="patientTable">
                            <thead>
                                <tr>
                                    <th class="px-3 py-3">No</th>
                                    <th class="px-3 py-3">No Pasien</th>
                                    <th class="px-3 py-3">Nama & Foto</th>
                                    <th class="px-3 py-3">Umur</th>
                                    <th class="px-3 py-3">Jenis Kelamin</th>
                                    <th class="px-3 py-3">Tgl Daftar</th>
                                    <th class="px-3 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $item)
                                <tr>
                                    <td class="px-3 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-3">{{ $item->no_pasien }}</td>
                                    <td class="px-3 py-3">
                                        <div class="d-flex align-items-center">
                                            @if($item->foto)
                                                <img src="{{ \Storage::url($item->foto) }}" class="rounded-circle me-3" width="50" height="50" alt="{{ $item->nama }}">
                                            @else
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                    {{ strtoupper(substr($item->nama, 0, 1)) }}
                                                </div>
                                            @endif
                                            <span>{{ $item->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">{{ $item->umur }} tahun</td>
                                    <td class="px-3 py-3">
                                        <span class="badge bg-{{ $item->jenis_kelamin == 'Laki-laki' ? 'primary' : 'info' }} px-3 py-2">
                                            {{ $item->jenis_kelamin }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="px-3 py-3">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pasien.edit', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('pasien.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $pasien->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#patientTable').DataTable({
            "pageLength": 10,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)"
            }
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pasien akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush

@endsection