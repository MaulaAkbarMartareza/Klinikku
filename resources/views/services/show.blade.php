@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $service->image) }}" class="w-100 rounded-top" style="height: 300px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            <h2 class="text-white mb-0">{{ $service->name }}</h2>
                            <p class="text-white-50 mb-0">{{ $service->category }}</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                        <i class="ti ti-clock text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1">Durasi</h6>
                                        <p class="mb-0">{{ $service->duration }} Menit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                        <i class="ti ti-currency-dollar text-success"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1">Harga</h6>
                                        <p class="mb-0">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                        <i class="ti ti-calendar text-info"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-1">Tersedia</h6>
                                        <p class="mb-0">Setiap Hari</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-4">Deskripsi Layanan</h5>
                        <p class="text-muted">{{ $service->description }}</p>

                        <div class="mt-4">
                            <h5 class="mb-3">Rating & Ulasan</h5>
                            
                            @if(auth()->check())
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <form action="{{ route('services.review', $service) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Rating Anda</label>
                                            <div class="rating">
                                                @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}">
                                                <label for="star{{ $i }}"><i class="ti ti-star-filled"></i></label>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ulasan Anda</label>
                                            <textarea class="form-control" name="review" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-send me-2"></i>Kirim Ulasan
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endif

                            <div class="reviews-container">
                                @forelse($service->reviews as $review)
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $review->user->avatar ?? asset('images/default-avatar.png') }}" 
                                                     class="rounded-circle me-2" 
                                                     width="40">
                                                <div>
                                                    <h6 class="mb-0">{{ $review->user->name }}</h6>
                                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <div class="rating-display">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="ti ti-star{{ $i <= $review->rating ? '-filled text-warning' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="mb-0">{{ $review->review }}</p>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted py-4">
                                    <i class="ti ti-message-circle-off fs-1 mb-2"></i>
                                    <p>Belum ada ulasan untuk layanan ini</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5 class="mb-3">Statistik Layanan</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                                    <i class="ti ti-users text-primary"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Total Pasien</h6>
                                                    <h3 class="mb-0">{{ $service->appointments_count }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                                    <i class="ti ti-star text-success"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Rating Rata-rata</h6>
                                                    <h3 class="mb-0">{{ number_format($service->reviews_avg_rating, 1) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg sticky-top" style="top: 2rem;">
                <div class="card-body p-4">
                    <h5 class="mb-4">Buat Janji Temu</h5>
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <div class="mb-3">
                            <label class="form-label">Pilih Tanggal</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Waktu</label>
                            <select class="form-select" name="time" required>
                                <option value="">Pilih Waktu</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" name="notes" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ti ti-calendar-plus me-2"></i>Buat Janji
                        </button>
                    </form>

                    <hr class="my-4">

                    <h5 class="mb-4">Butuh Bantuan?</h5>
                    <div class="d-grid gap-2">
                        <a href="tel:+6281234567890" class="btn btn-outline-primary">
                            <i class="ti ti-phone me-2"></i>Hubungi Kami
                        </a>
                        <a href="https://wa.me/6281234567890" class="btn btn-success">
                            <i class="ti ti-brand-whatsapp me-2"></i>WhatsApp
                        </a>
                    </div>
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

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
}

.sticky-top {
    z-index: 1020;
}
</style>
@endsection 