@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-success text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-calendar-plus fs-4 me-2"></i>
                        <h5 class="card-title mb-0">Buat Janji Temu Baru</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <!-- Pilih Pasien -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Pilih Pasien</label>
                                    <select class="form-select @error('patient_id') is-invalid @enderror" 
                                            name="patient_id" required>
                                        <option value="">Pilih Pasien</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">
                                                {{ $patient->name }} - {{ $patient->medical_record_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pilih Layanan -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Pilih Layanan</label>
                                    <select class="form-select @error('service_id') is-invalid @enderror" 
                                            name="service_id" required>
                                        <option value="">Pilih Layanan</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">
                                                {{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pilih Dokter -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Pilih Dokter</label>
                                    <select class="form-select @error('doctor_id') is-invalid @enderror" 
                                            name="doctor_id" required>
                                        <option value="">Pilih Dokter</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">
                                                {{ $doctor->name }} - {{ $doctor->specialty }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal & Waktu -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Janji</label>
                                    <input type="date" 
                                           class="form-control @error('appointment_date') is-invalid @enderror" 
                                           name="appointment_date" 
                                           required>
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Waktu Janji</label>
                                    <select class="form-select @error('appointment_time') is-invalid @enderror" 
                                            name="appointment_time" required>
                                        <option value="">Pilih Waktu</option>
                                        @foreach(['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'] as $time)
                                            <option value="{{ $time }}">{{ $time }}</option>
                                        @endforeach
                                    </select>
                                    @error('appointment_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Catatan (Opsional)</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                                              name="notes" 
                                              rows="3"></textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="ti ti-device-floppy me-2"></i>Buat Janji
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-light ms-2">
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

<style>
.form-control, .form-select {
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    border: 1px solid rgba(0,0,0,0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #28c76f;
    box-shadow: 0 0 0 0.25rem rgba(40, 199, 111, 0.25);
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
}
</style>
@endsection 