@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="fw-bold mb-2">
                                <i class="ti ti-calendar-time fs-2 me-2"></i>Jadwal Dokter
                            </h2>
                            <p class="mb-0 opacity-75">Kelola dan lihat jadwal praktik dokter</p>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <div class="btn-group">
                                <button class="btn btn-light" onclick="previousWeek()">
                                    <i class="ti ti-chevron-left"></i>
                                </button>
                                <button class="btn btn-light px-4" id="currentWeek">
                                    {{ now()->startOfWeek()->format('d M') }} - 
                                    {{ now()->endOfWeek()->format('d M Y') }}
                                </button>
                                <button class="btn btn-light" onclick="nextWeek()">
                                    <i class="ti ti-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="ti ti-users text-primary fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Total Dokter</h6>
                            <h3 class="fw-bold mb-0">{{ $doctors->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="ti ti-calendar-check text-success fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Praktik Hari Ini</h6>
                            <h3 class="fw-bold mb-0">
                                {{ $doctors->filter(function($doc) { 
                                    return $doc->schedules->where('day', now()->format('l'))->count() > 0;
                                })->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="ti ti-clock-play text-info fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Slot Tersedia</h6>
                            <h3 class="fw-bold mb-0">
                                {{ $doctors->sum(function($doc) { return $doc->availability['available']; }) }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="ti ti-calendar-stats text-warning fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Total Janji</h6>
                            <h3 class="fw-bold mb-0">
                                {{ $doctors->sum(function($doc) { return $doc->appointments->count(); }) }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Calendar -->
    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle schedule-table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Dokter</th>
                            @foreach($currentWeek as $date)
                                <th class="border-0 px-4 py-3 text-center {{ $date->isToday() ? 'bg-primary text-white' : '' }}">
                                    <div class="fw-bold">{{ $date->format('D') }}</div>
                                    <small>{{ $date->format('d M') }}</small>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctors as $doctor)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-wrapper">
                                        <img src="{{ $doctor->avatar ?? asset('images/default-avatar.png') }}" 
                                             class="rounded-circle" 
                                             width="40" 
                                             height="40">
                                        <span class="status-indicator {{ $doctor->is_available ? 'bg-success' : 'bg-danger' }}"></span>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0">{{ $doctor->name }}</h6>
                                        <small class="text-muted">{{ $doctor->specialty }}</small>
                                    </div>
                                </div>
                            </td>
                            @foreach($currentWeek as $date)
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $schedule = $doctor->schedules
                                            ->where('day', $date->format('l'))
                                            ->first();
                                    @endphp
                                    
                                    @if($schedule)
                                        <div class="schedule-slot available">
                                            <div class="time-range">
                                                {{ Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                                {{ Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </div>
                                            <div class="appointment-count mt-1">
                                                @php
                                                    $appointments = $doctor->appointments
                                                        ->where('appointment_date', $date->format('Y-m-d'))
                                                        ->count();
                                                @endphp
                                                <span class="badge bg-{{ $appointments > 0 ? 'warning' : 'success' }}">
                                                    {{ $appointments }} Janji
                                                </span>
                                            </div>
                                            <button class="btn btn-sm btn-primary mt-2" 
                                                    onclick="bookAppointment('{{ $doctor->id }}', '{{ $date->format('Y-m-d') }}')">
                                                <i class="ti ti-plus"></i> Buat Janji
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">Tidak Praktik</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Styling */
.schedule-table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.avatar-wrapper {
    position: relative;
    display: inline-block;
}

.status-indicator {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
}

.schedule-slot {
    background: #f8f9fa;
    border-radius: 0.75rem;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.schedule-slot:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08);
}

.schedule-slot.available {
    background: linear-gradient(to bottom, #ffffff, #f8f9fa);
}

.time-range {
    font-weight: 600;
    color: #4e73df;
}

.appointment-count .badge {
    font-weight: 500;
    padding: 0.5em 0.75em;
}

.btn-group .btn {
    padding: 0.75rem 1rem;
    font-weight: 500;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
}

/* Animations */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.card:hover {
    animation: pulse 2s infinite;
}
</style>

<script>
function bookAppointment(doctorId, date) {
    // Implementasi booking appointment
    window.location.href = `/appointments/create?doctor_id=${doctorId}&date=${date}`;
}

function previousWeek() {
    // Implementasi navigasi minggu sebelumnya
}

function nextWeek() {
    // Implementasi navigasi minggu selanjutnya
}

// Tambahkan efek hover yang smooth
document.querySelectorAll('.schedule-slot').forEach(slot => {
    slot.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 0.5rem 1rem rgba(0,0,0,0.15)';
    });

    slot.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
    });
});
</script>
@endsection 