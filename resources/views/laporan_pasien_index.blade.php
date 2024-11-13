@extends('layout.app_modern_laporan')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-0">
                        <i class="ti ti-file-analytics text-primary me-2"></i>
                        Laporan Data Pasien
                    </h3>
                    <p class="text-muted mb-0">Daftar lengkap data pasien terkini</p>
                </div>
                
                <!-- Export Buttons -->
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="ti ti-printer me-2"></i>Cetak
                    </button>
                    <button class="btn btn-outline-success" onclick="exportToExcel()">
                        <i class="ti ti-file-export me-2"></i>Ekspor Excel
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="patientTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>No. Pasien</th>
                            <th>Nama Lengkap</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Registrasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-medium">{{ $item->no_pasien }}</span>
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->umur }} tahun</td>
                            <td>
                                @if($item->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-soft-primary text-primary">
                                        <i class="ti ti-mars me-1"></i>Laki-laki
                                    </span>
                                @else
                                    <span class="badge bg-soft-info text-info">
                                        <i class="ti ti-venus me-1"></i>Perempuan
                                    </span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Tidak ada data pasien</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $models->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Card Styling */
    .card {
        background: #ffffff;
        transition: box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }
    .table th {
        font-weight: 600;
        color: #344767;
        border-bottom-width: 1px;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.75rem;
    }
    .table td {
        padding: 1rem;
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Badge Styling */
    .badge {
        padding: 0.5rem 0.8rem;
        font-weight: 500;
        font-size: 0.75rem;
    }
    .bg-soft-primary {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
    .bg-soft-info {
        background-color: rgba(var(--bs-info-rgb), 0.1);
    }

    /* Button Styling */
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    /* Print Styles */
    @media print {
        .btn, .pagination {
            display: none;
        }
        .card {
            box-shadow: none !important;
        }
        .table {
            width: 100% !important;
        }
    }

    /* Custom Colors */
    :root {
        --bs-primary: #4e73df;
        --bs-primary-rgb: 78, 115, 223;
        --bs-info: #36b9cc;
        --bs-info-rgb: 54, 185, 204;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        const table = document.getElementById('patientTable');
        const wb = XLSX.utils.table_to_book(table, {sheet: "Laporan Pasien"});
        XLSX.writeFile(wb, 'laporan_pasien.xlsx');
    }
</script>
@endpush

@endsection