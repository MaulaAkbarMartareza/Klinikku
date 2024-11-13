@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('services.search') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       name="query" 
                                       placeholder="Cari layanan..."
                                       value="{{ request('query') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" name="category">
                                <option value="">Semua Kategori</option>
                                @foreach(['umum', 'gigi', 'anak', 'spesialis'] as $cat)
                                    <option value="{{ $cat }}" 
                                            {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-search me-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-danger text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="ti ti-heartbeat fs-4 me-2"></i>Layanan Kami
                        </h5>
                        <a href="{{ route('services.create') }}" class="btn btn-light rounded-pill">
                            <i class="ti ti-plus me-2"></i>Tambah Layanan
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Layanan Umum -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body p-4">
                                    <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3">
                                        <i class="ti ti-stethoscope fs-2"></i>
                                    </div>
                                    <h4>Pemeriksaan Umum</h4>
                                    <p class="text-muted">Layanan pemeriksaan kesehatan umum dengan dokter berpengalaman.</p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary rounded-pill">Rp 150.000</span>
                                        <button class="btn btn-sm btn-outline-primary rounded-pill">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Layanan Gigi -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body p-4">
                                    <div class="feature-icon bg-info bg-gradient text-white rounded-3 mb-3">
                                        <i class="ti ti-tooth fs-2"></i>
                                    </div>
                                    <h4>Perawatan Gigi</h4>
                                    <p class="text-muted">Layanan kesehatan gigi lengkap dengan peralatan modern.</p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-info rounded-pill">Rp 200.000</span>
                                        <button class="btn btn-sm btn-outline-info rounded-pill">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Layanan Anak -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="card-body p-4">
                                    <div class="feature-icon bg-success bg-gradient text-white rounded-3 mb-3">
                                        <i class="ti ti-baby-carriage fs-2"></i>
                                    </div>
                                    <h4>Kesehatan Anak</h4>
                                    <p class="text-muted">Layanan kesehatan khusus anak dengan pendekatan ramah anak.</p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success rounded-pill">Rp 175.000</span>
                                        <button class="btn btn-sm btn-outline-success rounded-pill">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tambahkan layanan lainnya di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.feature-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.75rem;
}

.hover-card {
    transition: all 0.3s ease;
    border-radius: 1rem;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,0.175) !important;
}

.badge {
    padding: 0.6em 1em;
    font-weight: 500;
}

.btn-sm {
    padding: 0.4em 1em;
}
</style>
@endsection 