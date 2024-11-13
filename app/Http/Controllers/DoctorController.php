<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['specialty', 'schedules'])
            ->withCount('appointments')
            ->get();

        return view('doctors.index', compact('doctors'));
    }

    public function show(Doctor $doctor)
    {
        $doctor->load(['specialty', 'schedules', 'appointments' => function($query) {
            $query->whereDate('appointment_date', '>=', now())
                  ->orderBy('appointment_date');
        }]);

        $availability = $this->calculateAvailability($doctor);
        $upcomingAppointments = $doctor->appointments()
            ->with('patient')
            ->whereDate('appointment_date', '>=', now())
            ->orderBy('appointment_date')
            ->take(5)
            ->get();

        return view('doctors.show', compact('doctor', 'availability', 'upcomingAppointments'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty_id' => 'required|exists:specialties,id',
            'email' => 'required|email|unique:doctors',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:doctors',
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'schedules' => 'required|array',
            'schedules.*.day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'schedules.*.start_time' => 'required|date_format:H:i',
            'schedules.*.end_time' => 'required|date_format:H:i|after:schedules.*.start_time'
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('doctors', 'public');
            $validated['avatar'] = $path;
        }

        $doctor = Doctor::create($validated);

        // Simpan jadwal dokter
        foreach ($validated['schedules'] as $schedule) {
            $doctor->schedules()->create($schedule);
        }

        return redirect()->route('doctors.index')
            ->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function edit(Doctor $doctor)
    {
        $specialties = Specialty::all();
        $doctor->load('schedules');
        return view('doctors.edit', compact('doctor', 'specialties'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty_id' => 'required|exists:specialties,id',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:doctors,license_number,' . $doctor->id,
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'schedules' => 'required|array',
            'schedules.*.day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'schedules.*.start_time' => 'required|date_format:H:i',
            'schedules.*.end_time' => 'required|date_format:H:i|after:schedules.*.start_time'
        ]);

        if ($request->hasFile('avatar')) {
            if ($doctor->avatar) {
                Storage::disk('public')->delete($doctor->avatar);
            }
            $path = $request->file('avatar')->store('doctors', 'public');
            $validated['avatar'] = $path;
        }

        $doctor->update($validated);

        // Update jadwal
        $doctor->schedules()->delete();
        foreach ($validated['schedules'] as $schedule) {
            $doctor->schedules()->create($schedule);
        }

        return redirect()->route('doctors.show', $doctor)
            ->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->avatar) {
            Storage::disk('public')->delete($doctor->avatar);
        }
        
        $doctor->schedules()->delete();
        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Dokter berhasil dihapus!');
    }

    public function schedule()
    {
        $doctors = Doctor::with(['schedules', 'appointments' => function($query) {
            $query->whereDate('appointment_date', '>=', now())
                  ->orderBy('appointment_date');
        }])
        ->get()
        ->map(function($doctor) {
            $doctor->availability = $this->calculateAvailability($doctor);
            return $doctor;
        });

        $currentWeek = collect(range(0, 6))->map(function($day) {
            return Carbon::now()->startOfWeek()->addDays($day);
        });

        return view('doctors.schedule', compact('doctors', 'currentWeek'));
    }

    private function calculateAvailability($doctor)
    {
        $totalSlots = $doctor->schedules->sum(function($schedule) {
            return Carbon::parse($schedule->end_time)
                ->diffInHours(Carbon::parse($schedule->start_time));
        });

        $bookedSlots = $doctor->appointments
            ->where('appointment_date', today())
            ->count();

        return [
            'total' => $totalSlots * 2, // Asumsi 30 menit per slot
            'booked' => $bookedSlots,
            'available' => ($totalSlots * 2) - $bookedSlots
        ];
    }
}
