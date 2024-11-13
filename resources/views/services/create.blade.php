@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-danger text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-plus-circle fs-4 me-2"></i>
                        <h5 class="card-title mb-0">Tambah Layanan Baru</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Layanan</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-select" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="umum">Umum</option>
                                        <option value="gigi">Gigi</option>
                                        <option value="anak">Anak</option>
                                        <option value="spesialis">Spesialis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Durasi (Menit)</label>
                                    <input type="number" class="form-control" name="duration" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Layanan</label>
                                    <textarea class="form-control" name="description" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Gambar Layanan</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-2"></i>Simpan Layanan
                                </button>
                                <a href="{{ route('services.index') }}" class="btn btn-light ms-2">
                                    <i class="ti ti-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 