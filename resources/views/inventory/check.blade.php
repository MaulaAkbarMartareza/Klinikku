@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3 class="fw-bold mb-0">
                                <i class="ti ti-medicine fs-4 me-2"></i>Manajemen Stok Obat
                            </h3>
                            <p class="text-muted mb-0">Kelola inventaris obat dengan mudah</p>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end gap-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStockModal">
                                    <i class="ti ti-plus me-2"></i>Tambah Stok
                                </button>
                                <button class="btn btn-success" onclick="exportToExcel()">
                                    <i class="ti ti-file-spreadsheet me-2"></i>Export Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Stok -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="ti ti-alert-triangle text-danger fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Stok Kritis</h6>
                            <h3 class="fw-bold mb-0">{{ $criticalStock->count() }}</h3>
                            <small class="text-danger">
                                <i class="ti ti-arrow-down"></i>
                                Butuh pengisian segera
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="ti ti-alert-circle text-warning fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Stok Menipis</h6>
                            <h3 class="fw-bold mb-0">{{ $lowStock->count() }}</h3>
                            <small class="text-warning">
                                <i class="ti ti-arrow-down"></i>
                                Perlu perhatian
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="ti ti-medicine text-success fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Total Obat</h6>
                            <h3 class="fw-bold mb-0">{{ $medicines->count() }}</h3>
                            <small class="text-success">
                                <i class="ti ti-check"></i>
                                Terdaftar dalam sistem
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Stok -->
    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Nama Obat</th>
                            <th class="border-0 px-4 py-3">Kategori</th>
                            <th class="border-0 px-4 py-3">Stok</th>
                            <th class="border-0 px-4 py-3">Satuan</th>
                            <th class="border-0 px-4 py-3">Status</th>
                            <th class="border-0 px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicines as $medicine)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light p-2">
                                        <i class="ti ti-medicine"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0">{{ $medicine->name }}</h6>
                                        <small class="text-muted">{{ $medicine->code }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $medicine->category }}</td>
                            <td class="px-4 py-3">{{ $medicine->stock }}</td>
                            <td class="px-4 py-3">{{ $medicine->unit }}</td>
                            <td class="px-4 py-3">
                                @if($medicine->stock <= 5)
                                    <span class="badge bg-danger">Kritis</span>
                                @elseif($medicine->stock <= 10)
                                    <span class="badge bg-warning">Menipis</span>
                                @else
                                    <span class="badge bg-success">Tersedia</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <button type="button" 
                                        class="btn btn-sm btn-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateStockModal{{ $medicine->id }}">
                                    <i class="ti ti-edit me-1"></i>Update Stok
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="ti ti-medicine-off fs-1 text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada data obat</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Stok -->
<div class="modal fade" id="addStockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Stok Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory.store') }}" method="POST">
                    @csrf
                    <!-- Form fields -->
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Stok untuk setiap obat -->
@foreach($medicines as $medicine)
<div class="modal fade" id="updateStockModal{{ $medicine->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Stok {{ $medicine->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory.update', $medicine) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Form fields -->
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.card {
    border-radius: 1rem;
    overflow: hidden;
}

.table > :not(caption) > * > * {
    padding: 1rem;
}

.badge {
    padding: 0.6em 1em;
    font-weight: 500;
}

.btn {
    border-radius: 0.75rem;
}

.modal-content {
    border-radius: 1rem;
    border: none;
}
</style>

<script>
function exportToExcel() {
    // Implementasi export ke Excel
}
</script>
@endsection 