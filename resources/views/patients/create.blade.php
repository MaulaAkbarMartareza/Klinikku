@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="ti ti-user-plus me-2"></i>Tambah Pasien Baru
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('patients.store') }}" method="POST" class="row g-4">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control form-control-lg" name="nik" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-lg" name="birth_date" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select form-select-lg" name="gender" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Golongan Darah</label>
                            <select class="form-select form-select-lg" name="blood_type">
                                <option value="">Pilih Golongan Darah</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="address" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon</label>
                            <input type="tel" class="form-control form-control-lg" name="phone" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="ti ti-device-floppy me-2"></i>Simpan Data Pasien
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-light btn-lg rounded-pill px-5 ms-2">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control, .form-select {
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    border: 1px solid rgba(0,0,0,0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #4466f2;
    box-shadow: 0 0 0 0.25rem rgba(68, 102, 242, 0.25);
}

.btn-lg {
    padding: 1rem 2rem;
}
</style>
@endsection 